<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteManage;

class LandingPageContentSeeder extends Seeder
{
    public function run()
    {
        $contents = [
            [
                'section' => 'hero_slider',
                'title' => 'Hero Slider',
                'additional_content' => [
                    [
                        'image_path' => 'storage/images/gallery/album-c.png',
                        'title' => 'Welcome to IDBC',
                        'subtitle' => 'Islamic Digital Boarding College',
                        'button_text' => 'Learn More',
                        'button_link' => '#pendaftaran'
                    ],
                    [
                        'image_path' => 'storage/images/gallery/album-a.png',
                        'title' => 'Discover Excellence',
                        'subtitle' => 'In Islamic Education',
                        'button_text' => 'Lihat Program Studi',
                        'button_link' => '#fakultas'
                    ],
                    [
                        'image_path' => 'storage/images/gallery/album-b.png',
                        'title' => 'Join Our Community',
                        'subtitle' => 'Build Your Future',
                        'button_text' => 'Lihat Fasilitas',
                        'button_link' => '#fasilitas'
                    ]
                ],
                'order' => 1,
                'is_active' => true,
            ],
            [
                'section' => 'founder',
                'title' => 'Sambutan Founder',
                'content' => 'Sambutan dari founder IDBC',
                'image_path' => 'storage/images/founder/founder.jpg',
                'additional_content' => [
                    'name' => 'Ustadz Junaedy Alfan',
                    'position' => 'Founder IDBC',
                    'quote' => [
                        'Di semua negara maju, hal yang paling menonjol adalah tentang kemajuan literasi,
                            kedisiplinan, dan penghargaan terhadap profesi. Selain tentu saja kemajuan dalam hal
                            informasi dan teknologi.',
                        'Dan yang lebih penting, bahwa yang mendasari semua kemajuan itu adalah faktor pendidikan.
                            Sistem pendidikan, kurikulum, metode dan perhatian dari pemerintah, saling terkait dan tidak
                            bisa dipisahkan.',
                        'Indonesia, dalam pendidikan dan literasi sangat ketinggalan jauh dari negara-negara maju.
                            Sehingga kepedulian kita terhadap percepatan pendidikan melalui sarana prasarana IT dan
                            digital, sangat diperlukan.',
                        'Kampung IT Solo, sejak tahun 2014 sudah merintis dan memikirkan akan hal ini. Dan sampai
                            tahun 2024 ini, Kampung IT Solo sudah banyak mewarnai dunia pendidikan dan dakwah baik di
                            dalam maupun di luar negeri, melalui berbagai produk-produknya.'
                    ]
                ],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section' => 'vision',
                'title' => 'Visi',
                'content' => "Melahirkan Kader Da'i Teknopreneur (Programer & Entrepreneur)",
                'order' => 3,
                'is_active' => true,
            ],
            [
                'section' => 'mission',
                'title' => 'Misi',
                'content' => 'Misi IDBC',
                'additional_content' => [
                    'points' => [
                        [
                            'image' => '<i class="fas fa-graduation-cap text-4xl text-teal-700"></i>',
                            'Misi' => 'Menjadi alternatif pendidikan yang efisien sesuai dengan syariat dan tuntutan zaman',
                        ],
                        [
                            'image' => '<i class="fas fa-network-wired text-4xl text-teal-700"></i>',
                            'Misi' => 'Optimalisasi & integrasi teknologi dalam pendidikan dan dakwah.',
                        ],
                        [
                            'image' => '<i class="fas fa-mosque text-4xl text-teal-700"></i>',
                            'Misi' => 'Menerapkan konsep pendidikan robbany sesuai dengan manhaj salaf.',
                        ],
                        [
                            'image' => '<i class="fas fa-hands-helping text-4xl text-teal-700"></i>',
                            'Misi' => 'Mewujudkan manusia menjadi hamba dan khalifah.',
                        ]
                    ]
                ],
                'order' => 4,
                'is_active' => true,
            ],
            [
                'section' => 'facility',
                'title' => 'Sarana Pendukung Pendidikan IDBC',
                'content' => 'Fasilitas modern untuk mendukung proses belajar, praktik, dan pengembangan diri para santri',
                'additional_content' => [
                    'points' => [
                        [
                            'name' => 'Free Wifi Hotspot',
                            'icon' => '<i class="fas fa-wifi text-xl text-emerald-600"></i>',
                            'image_path' => 'storage/images/sarana/wifi.png',
                            'description' => 'Akses internet nirkabel 24 jam di seluruh area kampus untuk menunjang
                            kebutuhan belajar dan riset',
                        ],
                        [
                            'name' => 'Asrama & Tempat Belajar',
                            'icon' => '<i class="fas fa-bed text-xl text-emerald-600"></i>',
                            'image_path' => 'storage/images/sarana/asrama.png',
                            'description' => 'Lingkungan asrama yang nyaman dan kondusif, terintegrasi dengan ruang
                            belajar bersama',
                        ],
                        [
                            'name' => 'Lab. Bisnis Entrepreneur',
                            'icon' => '<i class="fas fa-store text-xl text-emerald-600"></i>',
                            'image_path' => 'storage/images/sarana/bisnis-lab.png',
                            'description' => 'Tempat praktik dan pengembangan jiwa kewirausahaan serta ide-ide bisnis
                            inovatif',
                        ],
                        [
                            'name' => 'Bookless Library System',
                            'icon' => '<i class="fas fa-tablet-alt text-xl text-emerald-600"></i>',
                            'image_path' => 'storage/images/sarana/bookless.png',
                            'description' => 'Sistem perpustakaan modern dengan akses ke ribuan koleksi buku dan jurnal
                            digital',
                        ],
                        [
                            'name' => 'Laboratorium Digital Smart Lab',
                            'icon' => '<i class="fas fa-laptop-code text-xl text-emerald-600"></i>',
                            'image_path' => 'storage/images/sarana/smart-lab.png',
                            'description' => 'Lab komputer dengan perangkat terkini untuk mendukung pembelajaran
                            pemrograman dan teknologi',
                        ],
                        [
                            'name' => 'Lab. Bisnis Fashion',
                            'icon' => '<i class="fas fa-tshirt text-xl text-emerald-600"></i>',
                            'image_path' => 'storage/images/sarana/fashion-lab.png',
                            'description' => 'Fasilitas untuk mengembangkan kreativitas, desain, dan keterampilan dalam
                            bisnis fashion',
                        ]
                    ]
                ],
                'order' => 5,
                'is_active' => true,
            ],
            [
                'section' => 'kompetensi',
                'title' => 'Triple Kompetensi IDBC',
                'content' => 'Kompetensi unggulan yang dikembangkan di IDBC untuk mencetak generasi pemimpin masa depan',
                'additional_content' => [
                    'points' => [
                        [
                            'name' => "DA'I",
                            'color' => 'emerald',
                            'icon' => '<i class="fas fa-user-tie"></i>',
                            'points' => [
                                'memiliki' => [
                                    'Adab Islam yang Paripurna',
                                    'Worldview keislaman yang lurus',
                                    'Tahfidz & Tahsin Quran Kualitas Sanad',
                                    'Skill Jurnalistik yang baik'
                                ],
                                'menguasai' => [
                                    'Ilmu-ilmu Fardhu Ain',
                                    'Literasi dan Eksplorasi Digital',
                                    'Public Speaking yang baik'
                                ],
                            ],
                        ],
                        [
                            'name' => "TECHNO",
                            'color' => 'blue',
                            'icon' => '<i class="fas fa-user-tie"></i>',
                            'points' => [
                                'menguasai' => [
                                    'Teknik Jaringan Komputer',
                                    'Instalasi Hardware & Software serta Troubleshooting',
                                    'Desain Grafis',
                                    'Multimedia dan Animasi',
                                    'Web Programming',
                                    'Mobile Apps'
                                ],
                            ],
                        ],
                        [
                            'name' => "PRENEUR",
                            'color' => 'amber',
                            'icon' => '<i class="fas fa-user-tie"></i>',
                            'points' => [
                                'memiliki' => [
                                    'Mindset Entrepreneur',
                                    'Memahami Konsep Bisnis Online',
                                    'Menguasai Tool Digital Marketing',
                                    'Memiliki usaha dan income minimal Rp 1 juta/bln'
                                ],
                                'menguasai' => [
                                    'Mampu membuat Business Model',
                                    'Menguasai 4 Pilar Bisnis',
                                    'Memahami Fiqih Muamalah Klasik & Kontemporer'
                                ],
                            ],
                        ],
                    ]
                ],
                'order' => 6,
                'is_active' => true,
            ],
            [
                'section' => 'news',
                'title' => 'Berita IDBC',
                'content' => 'Informasi terbaru seputar kegiatan dan prestasi IDBC',
                'additional_content' => [
                    'points' => [
                        [
                            'name' => 'Aksi Bela Palestina',
                            'image_path' => 'storage/images/news/palestina-1.png',
                            'description' => 'Solo — Puluhan santri dari Islamic Digital Boarding College (IDBC) bersama komunitas ACA (Aksi Cinta Al-Aqsha) menggelar aksi damai bertajuk Bela Palestina di kawasan Tugu Yogyakarta. Aksi ini merupakan bentuk solidaritas atas penderitaan rakyat Palestina yang terus menjadi korban agresi militer.',
                            'category' => 'Kegiatan Mahasiswa',
                            'link' => '#'
                        ],
                        [
                            'name' => 'Aksi Berbagi Takjil pada Bulan Ramadhan',
                            'image_path' => 'storage/images/news/ramadhan-1.png',
                            'description' => 'Solo, Dalam semangat kepedulian dan berbagi di bulan suci, Islamic Digital Boarding College (IDBC) mengadakan aksi Berbagi Takjil kepada masyarakat sekitar kawasan Slamet Riyadi, Solo.',
                            'category' => 'Kegiatan Mahasiswa',
                            'link' => '#'
                        ],
                        [
                            'name' => 'Seminar Affiliate Tiktok',
                            'image_path' => 'storage/images/news/seminar-1.png',
                            'description' => 'Solo, Untuk membekali santri dengan wawasan dunia digital, Islamic Digital Boarding College (IDBC) menyelenggarakan seminar bertajuk "Affiliate TikTok: Peluang Cuan di Era Digital" di Aula Utama IDBC.',
                            'category' => 'Kegiatan Kampus',
                            'link' => '#'
                        ],
                    ]
                ],
                'order' => 7,
                'is_active' => true,
            ],
            [
                'section' => 'youtube_video',
                'title' => 'Kanal Youtube IDBC',
                'content' => 'Dokumentasi kegiatan dan informasi terbaru dari IDBC',
                'additional_content' => [
                    'points' => [
                        [
                            'name' => 'Virtual Tour Kampus IDBC',
                            'description' => 'Jelajahi fasilitas kampus IDBC secara virtual',
                            'link' => 'https://www.youtube.com/embed/LHMNqM3-RMk?autoplay=1&mute=1&rel=0&playsinline=1',
                        ],
                        [
                            'name' => 'Proses Pembelajaran di IDBC',
                            'description' => 'Metode pembelajaran yang inovatif dan efektif',
                            'link' => 'https://www.youtube.com/embed/N0NIzGJrtpE?autoplay=1&mute=1&rel=0&playsinline=1',
                        ],
                    ]
                ],
                'order' => 8,
                'is_active' => true,
            ],
            [
                'section' => 'activity',
                'title' => 'Aktifitas IDBC',
                'content' => 'Dokumentasi kegiatan di lingkungan IDBC',
                'additional_content' => [
                    'points' => [
                        [
                            'name' => 'Kegiatan Belajar',
                            'description' => 'Sesi pembelajaran interaktif',
                            'image_path' => 'storage/images/aktivitas/foto-1.png',
                        ],
                        [
                            'name' => 'Laboratorium Komputer',
                            'description' => 'Fasilitas pembelajaran teknologi',
                            'image_path' => 'storage/images/aktivitas/foto-2.png',
                        ],
                        [
                            'name' => 'Perpustakaan Digital',
                            'description' => 'Akses literasi tanpa batas',
                            'image_path' => 'storage/images/aktivitas/foto-3.png',
                        ],
                        [
                            'name' => 'Diskusi Kelompok',
                            'description' => 'Kolaborasi dalam pembelajaran',
                            'image_path' => 'storage/images/aktivitas/foto-4.png',
                        ],
                    ]
                ],
                'order' => 9,
                'is_active' => true,
            ],
            [
                'section' => 'partner',
                'title' => 'Support Partner IDBC',
                'content' => '',
                'additional_content' => [
                    'points' => [
                        [
                            'name' => 'Al Wustho',
                            'image_path' => 'storage/images/support/alwustho.png',
                        ],
                        [
                            'name' => 'Aflaha',
                            'image_path' => 'storage/images/support/aflaha.png',
                        ],
                        [
                            'name' => 'Kampung IT',
                            'image_path' => 'storage/images/support/kampungit.png',
                        ],
                    ]
                ],
                'order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($contents as $content) {
            SiteManage::create($content);
        }
    }
}
