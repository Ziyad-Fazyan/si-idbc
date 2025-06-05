<script>
// Ensure jQuery is loaded
if (typeof jQuery === 'undefined') {
    console.error('jQuery is not loaded! Auto-refresh will not work.');
} else {
    console.log('jQuery loaded with version:', $.fn.jquery);
    
    $(document).ready(function() {
        // Initialize AJAX setup with CSRF token
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        if (!csrfToken) {
            console.error('CSRF token not found!');
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            cache: false
        });

        // Main refresh function
        function refreshData() {
            console.log('Refreshing data...', new Date().toLocaleTimeString());
            const kelasId = $('select[name="kelas_id"]').val();
            const gender = $('select[name="gender"]').val();

            let url = window.location.pathname;
            const params = [];
            if (kelasId) params.push(`kelas_id=${kelasId}`);
            if (gender) params.push(`gender=${gender}`);
            if (params.length > 0) url += '?' + params.join('&');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log('Data received:', data);
                    try {
                        updateAttendanceList(data);
                        updateSummaryStats(data);
                        updatePerformanceStats(data);
                        updateTodaySchedule(data);
                        updateFeaturedCourse(data);
                        updateStudentOfWeek(data);
                        updateLiveActivity(data);
                    } catch (e) {
                        console.error('Error updating dashboard:', e);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error refreshing dashboard:', status, error);
                }
            });
        }

        // Update attendance list
        function updateAttendanceList(data) {
            const container = $('#attendanceContainer');
            // Find the attendance list container (after the h4 header)
            const header = container.find('h4');
            const attendanceList = header.nextAll();
            
            // Remove existing attendance items
            attendanceList.remove();
            
            if (data.detailAbsensi && data.detailAbsensi.length > 0) {
                data.detailAbsensi.forEach(function(absen) {
                    const statusClass = absen.status === 'H' ? 'bg-green-500' : 
                                  (absen.status === 'S' ? 'bg-yellow-500' : 'bg-blue-500');
                    const statusText = absen.status === 'H' ? 'Present' : 
                                 (absen.status === 'S' ? 'Sick' : 'Permit');
                    const statusBgClass = absen.status === 'H' ? 'bg-green-100 text-green-700' : 
                                     (absen.status === 'S' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700');
                    
                    const imageHtml = absen.image ? 
                        `<img src="/storage/images/${absen.image}" alt="${absen.nama}" class="w-10 h-10 rounded-full object-cover border border-slate-200">` :
                        `<div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center border border-slate-200">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>`;
                    
                    const attendanceItem = $(`
                        <div class="flex items-center p-2 bg-blue-50/80 rounded-lg border border-blue-200/50 mb-2 hover:bg-slate-50 transition-colors">
                            <div class="relative shrink-0">
                                ${imageHtml}
                                <div class="absolute -bottom-1 -right-1 w-3 h-3 rounded-full border border-white ${statusClass}"></div>
                            </div>
                            <div class="ml-3 flex-1 min-w-0">
                                <div class="flex justify-between items-center gap-2">
                                    <div class="text-sm font-medium text-slate-700 truncate">${absen.nama}</div>
                                    <div class="text-xs text-slate-500 whitespace-nowrap">${absen.waktu}</div>
                                </div>
                                <div class="flex justify-between items-center gap-2 mt-1">
                                    <div class="text-xs text-slate-500 truncate">
                                        ${absen.nim} • ${absen.gender === 'L' ? 'Male' : 'Female'}
                                    </div>
                                    <div class="text-xs px-2 py-0.5 rounded-full whitespace-nowrap ${statusBgClass}">
                                        ${statusText}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    
                    container.append(attendanceItem);
                });
            } else {
                // Show empty state
                const emptyState = $(`
                    <div class="text-center py-6 text-slate-400 text-sm bg-slate-50 rounded-lg">
                        <i class="fas fa-calendar-xmark mb-2 text-lg"></i>
                        <p>No attendance data today</p>
                    </div>
                `);
                container.append(emptyState);
            }
        }

        // Update summary statistics
        function updateSummaryStats(data) {
            const statsContainer = $('#summaryContainer');
            
            statsContainer.html(`
                <div class="text-center p-2 bg-blue-50 rounded-lg">
                    <div class="text-xl font-bold text-blue-600">${data.totalMahasiswa || 0}</div>
                    <div class="text-xs text-slate-500 mt-1">Total</div>
                </div>
                <div class="text-center p-2 bg-green-50 rounded-lg">
                    <div class="text-xl font-bold text-green-600">${data.hadir || 0}</div>
                    <div class="text-xs text-slate-500 mt-1">Present</div>
                </div>
                <div class="text-center p-2 bg-yellow-50 rounded-lg">
                    <div class="text-xl font-bold text-yellow-600">${data.tidakHadir || 0}</div>
                    <div class="text-xs text-slate-500 mt-1">Sick</div>
                </div>
                <div class="text-center p-2 bg-red-50 rounded-lg">
                    <div class="text-xl font-bold text-red-600">${data.belumAbsen || 0}</div>
                    <div class="text-xs text-slate-500 mt-1">Absent</div>
                </div>
            `);
        }

        // Update performance statistics
        function updatePerformanceStats(data) {
            const performanceContainer = $('#performanceStats');
            
            if (data.kelasPerformance && data.kelasPerformance.length > 0) {
                let html = '';
                const colors = ['blue', 'green', 'yellow', 'purple', 'red', 'indigo', 'pink'];
                const gradeColors = {
                    'A': 'text-green-500',
                    'B': 'text-blue-500',
                    'C': 'text-yellow-500',
                    'D': 'text-orange-500',
                    'E': 'text-red-500'
                };
                
                data.kelasPerformance.forEach(function(performance, index) {
                    const colorIndex = index % colors.length;
                    const color = colors[colorIndex];
                    const initial = performance.name ? performance.name.charAt(0) : 'X';
                    const gradeColor = gradeColors[performance.grade] || 'text-gray-500';
                    
                    html += `
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-${color}-100 flex items-center justify-center">
                                    <span class="text-${color}-600 text-xs font-semibold">${initial}</span>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium">${performance.name || 'Tidak Diketahui'}</div>
                                    <div class="text-xs text-slate-500">${parseFloat(performance.attendance_rate).toFixed(1)}% Attendance</div>
                                </div>
                            </div>
                            <div class="${gradeColor} font-semibold text-sm">${performance.grade}</div>
                        </div>
                    `;
                });
                
                performanceContainer.html(html);
            } else {
                performanceContainer.html(`
                    <div class="text-center py-4">
                        <div class="text-gray-500 text-sm">Tidak ada data performa kelas</div>
                    </div>
                `);
            }
        }

        // Update today's schedule
        function updateTodaySchedule(data) {
            const slider = $('#slider');
            
            if (data.jadwalHariIni && data.jadwalHariIni.length > 0) {
                let html = '';
                
                data.jadwalHariIni.forEach(function(jadwal) {
                    const now = new Date();
                    const currentTime = now.getHours() * 3600 + now.getMinutes() * 60 + now.getSeconds();
                    const startTime = timeToSeconds(jadwal.start || '00:00:00');
                    const endTime = timeToSeconds(jadwal.ended || '00:00:00');
                    
                    let status = 'DONE';
                    let statusClass = 'bg-gray-500';
                    
                    if (currentTime >= startTime && currentTime <= endTime) {
                        status = 'ACTIVE';
                        statusClass = 'bg-blue-500';
                    } else if (currentTime < startTime) {
                        status = 'NEXT';
                        statusClass = 'bg-slate-500';
                    }
                    
                    html += `
                        <div class="min-w-full px-4">
                            <div class="bg-blue-50 rounded-lg p-3 border-l-4 border-blue-400">
                                <div class="text-blue-600 font-semibold text-sm mb-1">
                                    ${jadwal.matkul?.name || 'Tidak ada mata kuliah'}
                                </div>
                                <div class="text-slate-500 text-xs mb-1">
                                    ${jadwal.dosen?.dsn_name || 'Tidak ada dosen'}
                                </div>
                                <div class="text-slate-500 text-xs">
                                    ${jadwal.start || '00:00'} - ${jadwal.ended || '00:00'}
                                </div>
                                <div class="inline-block px-2 py-1 ${statusClass} text-white text-xs rounded-full mt-1">
                                    ${status}
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                slider.html(html);
            } else {
                slider.html(`
                    <div class="min-w-full px-4">
                        <div class="bg-gray-50 rounded-lg p-3 border-l-4 border-gray-400">
                            <div class="text-gray-600 font-semibold text-sm mb-1">Tidak Ada Jadwal</div>
                            <div class="text-slate-500 text-xs mb-1">Tidak ada jadwal kuliah hari ini</div>
                            <div class="text-slate-500 text-xs">--:-- - --:--</div>
                            <div class="inline-block px-2 py-1 bg-gray-500 text-white text-xs rounded-full mt-1">
                                LIBUR
                            </div>
                        </div>
                    </div>
                `);
            }
        }

        // Update featured course
        function updateFeaturedCourse(data) {
            const featuredContainer = $('#featuredContainer');
            const existingBg = featuredContainer.find('.absolute.inset-0');
            
            // Preserve the background gradient overlay
            let content = '';
            if (data.featuredCourse) {
                const course = data.featuredCourse;
                content = `
                    <div class="relative z-10 text-center text-white">
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-4 mx-auto cursor-pointer transition-all hover:scale-105 bg-white/20 backdrop-blur-sm">
                            <i class="fas fa-play text-2xl text-white ml-1"></i>
                        </div>
                        <h2 class="text-3xl font-bold mb-2">${course.matkul?.name || 'TIDAK ADA JADWAL'}</h2>
                        <p class="text-base opacity-90 mb-3">${course.dosen?.dsn_name || 'Tidak ada dosen'}</p>
                        <div class="flex justify-center space-x-2">
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-medium backdrop-blur-sm">
                                ${course.start || '00:00'} - ${course.ended || '00:00'}
                            </span>
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-medium backdrop-blur-sm">
                                ${course.kelas?.name || 'Tidak ada kelas'}
                            </span>
                        </div>
                    </div>
                `;
            } else {
                content = `
                    <div class="relative z-10 text-center text-white">
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-4 mx-auto cursor-pointer transition-all hover:scale-105 bg-white/20 backdrop-blur-sm">
                            <i class="fas fa-play text-2xl text-white ml-1"></i>
                        </div>
                        <h2 class="text-3xl font-bold mb-2">TIDAK ADA JADWAL</h2>
                        <p class="text-base opacity-90 mb-3">Tidak ada jadwal kuliah hari ini</p>
                        <div class="flex justify-center space-x-2">
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-medium backdrop-blur-sm">Libur</span>
                        </div>
                    </div>
                `;
            }
            
            featuredContainer.html(`
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-blue-700/20"></div>
                ${content}
            `);
        }

        // Update student of the week
        function updateStudentOfWeek(data) {
            const studentContainer = $('#studentOfWeek');
            // Find the content area after the header
            const header = studentContainer.find('.mb-3').first();
            const contentArea = header.nextAll();
            
            // Remove existing content
            contentArea.remove();
            
            if (data.studentOfWeek) {
                const student = data.studentOfWeek;
                const imageHtml = student.mhs_image ? 
                    `<img src="/storage/images/${student.mhs_image}" alt="Foto ${student.mhs_name}" class="w-12 h-12 rounded-full object-cover shadow-lg border-2 border-white">` :
                    `<div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white text-lg font-bold">${student.mhs_name.charAt(0)}</div>`;
                
                const newContent = $(`
                    <div class="relative mb-3">
                        <div class="w-14 h-14 mx-auto rounded-xl bg-gradient-to-br from-blue-600 to-blue-500 overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center text-white text-lg">
                                ${imageHtml}
                            </div>
                        </div>
                    </div>
                    <h4 class="font-semibold text-base text-slate-800 mb-1">${student.mhs_name}</h4>
                    <p class="text-slate-500 text-xs mb-3">${student.kelas && student.kelas.length > 0 ? student.kelas[0].name : 'Mahasiswa'}</p>
                    <div class="bg-blue-50/80 rounded-xl p-3 border border-blue-200/50">
                        <div class="text-2xl font-bold text-blue-600">${student.attendance_count || 0}</div>
                        <div class="text-slate-500 text-xs">Kehadiran Minggu Ini</div>
                    </div>
                `);
                
                studentContainer.append(newContent);
            } else {
                const emptyContent = $(`
                    <div class="relative mb-3">
                        <div class="w-14 h-14 mx-auto rounded-xl bg-gradient-to-br from-blue-600 to-blue-500 overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center text-white text-lg">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <h4 class="font-semibold text-base text-slate-800 mb-1">Belum Ada</h4>
                    <p class="text-slate-500 text-xs mb-3">Mahasiswa Terbaik</p>
                    <div class="bg-blue-50/80 rounded-xl p-3 border border-blue-200/50">
                        <div class="text-2xl font-bold text-blue-600">0</div>
                        <div class="text-slate-500 text-xs">Kehadiran Minggu Ini</div>
                    </div>
                `);
                
                studentContainer.append(emptyContent);
            }
        }

        // Update live activity
        function updateLiveActivity(data) {
            const liveActivityContainer = $('#liveActivity');
            
            let content = '';
            
            if (data.activeSession) {
                const session = data.activeSession;
                content += `
                    <div class="text-center mb-3">
                        <div class="text-xl font-semibold text-blue-600 mb-1">${session.start} - ${session.ended}</div>
                        <p class="text-slate-500 text-xs">Sesi Saat Ini</p>
                    </div>
                    <div class="bg-sky-50 rounded-xl p-3 mb-3 border border-sky-200">
                        <div class="text-slate-700 font-medium text-sm mb-1">🎓 ${session.matkul?.name || 'Tidak ada mata kuliah'}</div>
                        <div class="text-slate-500 text-xs">${session.dosen?.dsn_name || 'Tidak ada dosen'}</div>
                    </div>
                `;
            } else {
                content += `
                    <div class="text-center mb-3">
                        <div class="text-xl font-semibold text-blue-600 mb-1">--:-- - --:--</div>
                        <p class="text-slate-500 text-xs">Tidak Ada Sesi Aktif</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 mb-3 border border-gray-200">
                        <div class="text-slate-700 font-medium text-sm mb-1">🎓 Tidak Ada Mata Kuliah</div>
                        <div class="text-slate-500 text-xs">Tidak Ada Dosen</div>
                    </div>
                `;
            }
            
            content += '<div class="space-y-2">';
            
            if (data.upcomingSessions && data.upcomingSessions.length > 0) {
                data.upcomingSessions.forEach(function(session, index) {
                    const bgClass = index === 0 ? 'bg-blue-50 border border-blue-200' : 'bg-indigo-50 border border-indigo-200';
                    content += `
                        <div class="flex justify-between items-center p-2 ${bgClass} rounded-lg">
                            <span class="text-slate-700 text-xs">${session.matkul?.name || 'Tidak ada mata kuliah'}</span>
                            <span class="text-slate-500 text-xs">${session.start} - ${session.ended}</span>
                        </div>
                    `;
                });
            } else {
                content += `
                    <div class="flex justify-between items-center p-2 bg-gray-50 rounded-lg border border-gray-200">
                        <span class="text-slate-700 text-xs">Tidak Ada Jadwal Mendatang</span>
                        <span class="text-slate-500 text-xs">--:-- - --:--</span>
                    </div>
                `;
            }
            
            content += '</div>';
            
            liveActivityContainer.html(content);
        }

        // Helper function to convert time string to seconds
        function timeToSeconds(timeString) {
            const parts = timeString.split(':');
            return parseInt(parts[0]) * 3600 + parseInt(parts[1]) * 60 + (parseInt(parts[2]) || 0);
        }

        // Clock function
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;
            
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const dateString = now.toLocaleDateString('id-ID', options);
            
            $('#live-clock').text(timeString);
            $('#current-date').text(dateString);
        }

        // Event handlers
        $('select[name="kelas_id"], select[name="gender"]').change(function() {
            // Small delay to allow for proper form processing
            setTimeout(refreshData, 100);
        });
        
        $('form').submit(function(e) {
            e.preventDefault();
            refreshData();
        });

        // Initialize
        updateClock();
        setInterval(updateClock, 1000);
        
        // Initial refresh and set interval
        setTimeout(refreshData, 1000); // Initial delay
        setInterval(refreshData, 3000); // Refresh every 30 seconds
        
        console.log('Dashboard initialized successfully');
    });
}
</script>