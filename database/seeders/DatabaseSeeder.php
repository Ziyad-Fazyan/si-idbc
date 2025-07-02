<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use App\Models\User;
// DEFAULT AUTHENTIKASI
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\MahasiswaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            DosenSeeder::class,
            GalleryAlbumSeeder::class,
            CommodityAcquisitionSeeder::class,
        ]);

        // SEEDER KHUSUS DATA MASTER AKADEMIK
        \App\Models\Fakultas::create([
            'name'       => 'Nasional',
            'code'       => 'NSL',
            'head_id'    => '1',
        ]);
        \App\Models\Fakultas::create([
            'name'       => 'Internasional',
            'code'       => 'INT',
            'head_id'    => '1',
        ]);
        \App\Models\ProgramStudi::create([
            'name'       => 'Programming',
            'code'       => 'RPL',
            // 'cnim'       => '',
            'title'      => '',
            'level'      => '',
            'slug'       => Str::slug('Programming'),
            'head_id'    => '1',
            'faku_id'    => '1',
        ]);
        \App\Models\ProgramStudi::create([
            'name'       => 'Desain',
            'code'       => 'DKV',
            // 'cnim'       => '',
            'title'      => '',
            'level'      => '',
            'slug'       => Str::slug('Desain'),
            'head_id'    => '1',
            'faku_id'    => '1',
        ]);
        \App\Models\ProgramStudi::create([
            'name'       => 'Jerman',
            'code'       => 'JER',
            // 'cnim'       => '',
            'title'      => '',
            'level'      => '',
            'slug'       => Str::slug('Jerman'),
            'head_id'    => '1',
            'faku_id'    => '2',
        ]);
        \App\Models\TahunAkademik::create([
            'name'       => 'TA. 2025/2026',
            'code'       => '012023',
            'semester'   => '1',
            'year_start' => '2025',
        ]);
        \App\Models\TahunAkademik::create([
            'name'       => 'TA. 2025/2026',
            'code'       => '022023',
            'semester'   => '2',
            'year_start' => '2025',
        ]);

        $this->call([
            MahasiswaSeeder::class,
            LandingPageContentSeeder::class,
        ]);

        \App\Models\ProgramKuliah::create([
            'name'       => 'Gelombang 1',
            'code'       => 'G1RP-2025',
            'wave'       => 'Gelombang I',
            'taka_id'    => '1',
            'pstudi_id'  => '1',
        ]);
        \App\Models\Kurikulum::create([
            'name'       => 'Kurikulum 2020',
            'code'       => 'K20',
            'desc'       => 'Kurikulum 2020 adalah kurikulum dirancang 25 Tahun',
            'year_start' => '2019',
            'year_ended' => '2024',
        ]);
        \App\Models\MataKuliah::create([
            'name'       => 'Adab',
            'code'       => 'ADB',
            'desc'       => 'Matakuliah yang membahas mengenai adab',
            'kuri_id'    => '1',
            'taka_id'    => '1',
            'dosen_1'    => '1',
            'dosen_2'    => '2',
            'pstudi_id'  => '1',
        ]);
        \App\Models\MataKuliah::create([
            'name'       => 'Laravel',
            'code'       => 'LVL',
            'desc'       => 'Matakuliah yang membahas mengenai Laravel',
            'kuri_id'    => '1',
            'taka_id'    => '1',
            'dosen_1'    => '1',
            'dosen_2'    => '2',
            'pstudi_id'  => '1',
        ]);
        \App\Models\MataKuliah::create([
            'name'       => 'UI / UX',
            'code'       => 'UIX',
            'desc'       => 'Matakuliah yang membahas mengenai UI / UX',
            'kuri_id'    => '1',
            'taka_id'    => '2',
            'dosen_1'    => '2',
            'pstudi_id'  => '1',
        ]);
        \App\Models\MataKuliah::create([
            'name'       => 'Photoshop',
            'code'       => 'PSD',
            'desc'       => 'Matakuliah yang membahas mengenai Photoshop',
            'kuri_id'    => '1',
            'taka_id'    => '2',
            'dosen_1'    => '2',
            'pstudi_id'  => '2',
        ]);
        \App\Models\Kelas::create([
            'name'       => 'TI-2025-RP-1A',
            'code'       => 'TI-2025-RP-1A',
            'capacity'   => '32',
            'dosen_id'   => '1',
            'proku_id'   => '1',
            'taka_id'    => '1',
            'pstudi_id'  => '1',
        ]);
        \App\Models\Kelas::create([
            'name'       => 'TI-2025-RP-1B',
            'code'       => 'TI-2025-RP-1B',
            'capacity'   => '32',
            'dosen_id'   => '2',
            'proku_id'   => '1',
            'taka_id'    => '1',
            'pstudi_id'  => '1',
        ]);

        \App\Models\Gedung::create([
            'name'       => 'Palestina Land',
            'code'       => 'PLN',
        ]);
        \App\Models\Gedung::create([
            'name'       => 'Turki Land',
            'code'       => 'TLN',
        ]);
        \App\Models\Gedung::create([
            'name'       => 'Gedung Pink',
            'code'       => 'GPK',
        ]);
        \App\Models\Gedung::create([
            'name'       => 'Gedung Madinah',
            'code'       => 'GMA',
        ]);
        \App\Models\Ruang::create([
            'gedung_id'    => '1',
            'floor'      => '1',
            'type'       => '1',
            'name'       => 'Kamar PA',
            'code'       => 'C-101',
        ]);
        \App\Models\Ruang::create([
            'gedung_id'    => '2',
            'floor'      => '1',
            'type'       => '1',
            'name'       => 'Kelas 102',
            'code'       => 'C-102',
        ]);
        \App\Models\Ruang::create([
            'gedung_id'    => '3',
            'floor'      => '1',
            'type'       => '1',
            'name'       => 'Dapur',
            'code'       => 'C-103',
        ]);
        \App\Models\Ruang::create([
            'gedung_id'    => '3',
            'floor'      => '2',
            'type'       => '1',
            'name'       => 'Kelas',
            'code'       => 'C-104',
        ]);

        \App\Models\JadwalKuliah::create([
            'makul_id'  => '1',
            'kelas_id'  => '1',
            'dosen_id'  => '1',
            'ruang_id'  => '1',
            'days_id'  => '1',
            'code'  => Str::random(8),
            'start'  => '01:00:00',
            'ended'  => '23:00:00',

        ]);
        \App\Models\JadwalKuliah::create([
            'makul_id'  => '1',
            'kelas_id'  => '2',
            'dosen_id'  => '1',
            'ruang_id'  => '1',
            'days_id'  => '1',
            'code'  => Str::random(8),
            'start'  => '01:00:00',
            'ended'  => '23:00:00',

        ]);
        \App\Models\JadwalKuliah::create([
            'makul_id'  => '1',
            'kelas_id'  => '2',
            'dosen_id'  => '1',
            'ruang_id'  => '1',
            'days_id'  => '1',
            'code'  => Str::random(8),
            'start'  => '01:00:00',
            'ended'  => '23:00:00',

        ]);
        \App\Models\JadwalKuliah::create([
            'makul_id'  => '1',
            'kelas_id'  => '1',
            'dosen_id'  => '1',
            'ruang_id'  => '1',
            'days_id'  => '1',
            'code'  => Str::random(8),
            'start'  => '01:00:00',
            'ended'  => '23:00:00',
        ]);

        $this->call([
            CommoditySeeder::class,
        ]);

        // TAGIHAN KULIAH
        \App\Models\TagihanKuliah::create([
            'proku_id'    => '1',
            'name'    => 'Syahriah Bulan 1',
            'code'    => 'SPP-' . Str::random(8),
            'price'    => '1700000',
        ]);
        // TAGIHAN KULIAH
        \App\Models\TagihanKuliah::create([
            'proku_id'    => '1',
            'name'    => 'Syahriah Bulan 1',
            'code'    => 'SPP-' . Str::random(8),
            'price'    => '1700000',
        ]);

        // DEFAULT TUGAS SEEDER
        \App\Models\StudentTask::create([
            'dosen_id'    => '1',
            'jadkul_id'    => '1',
            'code'    => Str::random(8),
            'title'    => 'First Task',
            'detail_task'    => 'First Task Deskription',
            'exp_date'  => Carbon::now()->addDays(7),
            'exp_time'  => Carbon::now()->addHours(12),
        ]);
        \App\Models\StudentTask::create([
            'dosen_id'    => '1',
            'jadkul_id'    => '2',
            'code'    => Str::random(8),
            'title'    => 'First Task',
            'detail_task'    => 'First Task Deskription',
            'exp_date'  => Carbon::now()->addDays(7),
            'exp_time'  => Carbon::now()->addHours(12),
        ]);
        \App\Models\StudentTask::create([
            'dosen_id'    => '1',
            'jadkul_id'    => '3',
            'code'    => Str::random(8),
            'title'    => 'Second Task',
            'detail_task'    => 'Second Task Deskription',
            'exp_date'  => Carbon::now()->addDays(7),
            'exp_time'  => Carbon::now()->addHours(12),
        ]);
        \App\Models\StudentTask::create([
            'dosen_id'    => '1',
            'jadkul_id'    => '4',
            'code'    => Str::random(8),
            'title'    => 'Second Task',
            'detail_task'    => 'Second Task Deskription',
            'exp_date'  => Carbon::now()->addDays(7),
            'exp_time'  => Carbon::now()->addHours(12),
        ]);

        // Kategori Berita
        $categories = [
            ['name' => 'Teknologi', 'desc' => 'Berita seputar teknologi'],
            ['name' => 'Bisnis', 'desc' => 'Berita seputar dunia bisnis'],
            ['name' => 'Kesehatan', 'desc' => 'Berita seputar kesehatan'],
            ['name' => 'Sains', 'desc' => 'Berita seputar ilmu pengetahuan'],
            ['name' => 'Hiburan', 'desc' => 'Berita seputar dunia hiburan'],
            ['name' => 'Olahraga', 'desc' => 'Berita seputar olahraga'],
            ['name' => 'Politik', 'desc' => 'Berita seputar politik'],
            ['name' => 'Mode', 'desc' => 'Berita seputar dunia mode'],
            ['name' => 'Travel', 'desc' => 'Berita seputar perjalanan'],
            ['name' => 'Makanan', 'desc' => 'Berita seputar makanan'],
            ['name' => 'Pendidikan', 'desc' => 'Berita seputar dunia pendidikan'],
            ['name' => 'Lingkungan', 'desc' => 'Berita seputar lingkungan'],
            ['name' => 'Gaya Hidup', 'desc' => 'Berita seputar gaya hidup'],
            ['name' => 'Opini', 'desc' => 'Opini dan pandangan'],
            ['name' => 'Cuaca', 'desc' => 'Berita seputar cuaca'],
            ['name' => 'Seni', 'desc' => 'Berita seputar seni'],
            ['name' => 'Film', 'desc' => 'Berita seputar dunia film'],
            ['name' => 'Musik', 'desc' => 'Berita seputar musik'],
            ['name' => 'Buku', 'desc' => 'Berita seputar dunia literatur'],
            ['name' => 'Ekonomi', 'desc' => 'Berita seputar ekonomi'],
        ];

        foreach ($categories as $category) {
            \App\Models\NewsCategory::create([
                'name' => $category['name'],
                'code' => Str::random(6),
                'slug' => Str::slug($category['name']),
                'desc' => $category['desc'],
            ]);
        }

        \App\Models\NewsPost::create([
            'category_id'    => '1',
            'author_id'    => '1',
            'name'    => 'Sample Post First',
            'code'    => Str::random(6),
            'slug'    => 'sample-post-first',
            'image'    => 'default/default-profile.jpg',
            'metadesc'    => 'Meta Descriptsion Sample',
            'keywords'    => 'Keywords 1, Keywords 2, Keywords 3',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, omnis quibusdam aliquam at nemo repellat nam ad adipisci itaque alias eveniet consequuntur molestiae cupiditate dolores, id magni autem vero quam, suscipit nulla facere molestias ipsum? Adipisci, animi natus. Modi, veniam doloribus assumenda in dolorem exercitationem quaerat tempora non temporibus magni earum voluptatibus autem quibusdam tempore voluptas aperiam, consequuntur alias fuga laudantium sed harum distinctio repudiandae facere omnis. Sint sunt dignissimos fugit velit voluptatibus adipisci esse minima explicabo. Nisi est architecto quasi suscipit amet quaerat nulla dolore illo quis inventore, error iusto nostrum eaque nemo, atque odio quas esse aut aperiam!',
        ]);

        \App\Models\NewsPost::create([
            'category_id'    => '2',
            'author_id'    => '1',
            'name'    => 'Sample Post Second',
            'code'    => Str::random(6),
            'slug'    => 'sample-post-second',
            'image'    => 'default/default-profile.jpg',
            'metadesc'    => 'Meta Descriptsion Sample',
            'keywords'    => 'Keywords 1, Keywords 2, Keywords 3',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, omnis quibusdam aliquam at nemo repellat nam ad adipisci itaque alias eveniet consequuntur molestiae cupiditate dolores, id magni autem vero quam, suscipit nulla facere molestias ipsum? Adipisci, animi natus. Modi, veniam doloribus assumenda in dolorem exercitationem quaerat tempora non temporibus magni earum voluptatibus autem quibusdam tempore voluptas aperiam, consequuntur alias fuga laudantium sed harum distinctio repudiandae facere omnis. Sint sunt dignissimos fugit velit voluptatibus adipisci esse minima explicabo. Nisi est architecto quasi suscipit amet quaerat nulla dolore illo quis inventore, error iusto nostrum eaque nemo, atque odio quas esse aut aperiam!',
        ]);

        \App\Models\Settings\WebSettings::create([
            'school_apps' => 'si-idbc v1.0 ',
            'school_name' => 'IDBC',
            'school_head' => 'Ust. Junadi Alfan',
            'school_desc' => 'Salam sejahtera bagi seluruh mahasiswa dan dosen! Saya sebagai Rektor IDBC dengan bangga menyambut Anda di portal Siakad kami. Platform ini adalah jembatan digital yang memudahkan akses dan meningkatkan efisiensi dalam proses akademik dan kemahasiswaan. Mari bersama-sama kita manfaatkan Siakad untuk menciptakan pengalaman belajar yang lebih baik dan membangun masa depan yang cerah bagi pendidikan kita.',
            'school_link' => 'https://instagram.com/ziyad_fazyan',
            'school_email' => 'idbc@internal-dev.id',
            'school_phone' => '+6287848799145',
            'social_ig' => 'https://instagram.com/ziyad_fazyan',
            'social_fb' => 'https://facebook.com/ziyad-fazyan',
            'social_in' => 'https://id.linkedin.com/in/ziyad-fazyan-292a07303',
            'social_tw' => 'https://x.com/ziyad_fazyan',
        ]);
    }
}
