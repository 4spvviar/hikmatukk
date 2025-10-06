<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\profile_sekolah;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Dodoy',
            'username' => 'AdminKapal',
            'password' => bcrypt(1234),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'kodoy',
            'username' => 'Operator1',
            'password' => bcrypt(12345),
            'role' => 'operator'
        ]);
        profile_sekolah::create([
            'nama_sekolah' => 'MTsN 7 Tasikmalaya',
            'kepala_sekolah' => 'Iki Alpian Hilmi',
            'foto'=>'logo.jpg',
            'logo'=>'mts7.jpeg',
            'npsn' => '1234567890',
            'alamat' => 'Kompleks Ponpes Al Manshuriyah No.335 Kampung Nanggerang, RT.027/RW.04, Kec. Salawu, Kabupaten Tasikmalaya',
            'kontak' => '021-12345678',
            'visi_misi' => 'Visi: Menjadi sekolah unggulan dalam bidang teknologi dan inovasi. Misi: 1. Meningkatkan kualitas pembelajaran. 2. Mengembangkan potensi siswa. 3. Membangun kerjasama dengan industri.',
            'tahun_berdiri' => 1996,
            'deskripsi' => 'Pada saat ini MTsN 7 Tasikmalaya merupakan satu-satunya MTs  Negeri di kecamatan Salawu. Ditinjau dari segi strategis sosial-ekonomi menunjukan bahwa MTsN 7 Tasikmalaya terletak di lingkungan  pedesaan dan berada di lingkungan masyarakat yang taraf ekonominya menengah kebawah serta berada di lingkungan Pondok  Pesantren . Hal ini dapat dimanfaatkan sebagai pusat-pusat sumber belajar peserta didik dalam menambah wawasan pengetahuan dan  mengembangkan kecapakan hidup (life skill)',
            'created_at' => now(),
            'updated_at' => now()

        ]);

    }
}
