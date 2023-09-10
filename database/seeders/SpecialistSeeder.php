<?php

namespace Database\Seeders;

use App\Models\Specialist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $specialist_data = [[
            'specialist_id' => 'AM0001',
            'name_en' => 'Anatomy',
            'name_th' => 'กายวิภาคศาสตร์',
        ],
        [
            'specialist_id' => 'BC0001',
            'name_en' => 'Biochemistry',
            'name_th' => 'ชีวเคมี',
        ],
        [
            'specialist_id' => 'CD0001',
            'name_en' => 'Community Dentistry',
            'name_th' => 'ทันตกรรมชุมชน',
        ],
        [
            'specialist_id' => 'MB0001',
            'name_en' => 'Microbiology',
            'name_th' => 'จุลชีววิทยา',
        ],
        [
            'specialist_id' => 'OC0001',
            'name_en' => 'Occlusion',
            'name_th' => 'ทันตกรรมบดเคี้ยว',
        ],
        [
            'specialist_id' => 'OT0001',
            'name_en' => 'Orthodontics',
            'name_th' => 'ทันตกรรมจัดฟัน',
        ],
        [
            'specialist_id' => 'OD0001',
            'name_en' => 'Operative Dentistry',
            'name_th' => 'ทันตกรรมหัตถการ',
        ],
        [
            'specialist_id' => 'OM0001',
            'name_en' => 'Oral Medicine',
            'name_th' => 'เวชศาสตร์ช่องปาก',
        ],
        [
            'specialist_id' => 'OS0001',
            'name_en' => 'Oral and Maxillofacial Surgery',
            'name_th' => 'ศัลยศาสตร์',
        ],
        [
            'specialist_id' => 'OP0001',
            'name_en' => 'Oral Pathology',
            'name_th' => 'ทันตพยาธิวิทยา',
        ],
        [
            'specialist_id' => 'PD0001',
            'name_en' => 'Prosthodontics',
            'name_th' => 'ทันตกรรมประดิษฐ์',
        ],
        [
            'specialist_id' => 'PG0001',
            'name_en' => 'Physiology',
            'name_th' => 'สรีรวิทยา',
        ],
        [
            'specialist_id' => 'PK0001',
            'name_en' => 'Pediatric Dentistry',
            'name_th' => 'ทันตกรรมสำหรับเด็ก',
        ],
        [
            'specialist_id' => 'PM0001',
            'name_en' => 'Pharmacology',
            'name_th' => 'เภสัชวิทยา',
        ],
        [
            'specialist_id' => 'PT0001',
            'name_en' => 'Periodontology',
            'name_th' => 'ปริทันตวิทยา',
        ],
        [
            'specialist_id' => 'RD0001',
            'name_en' => 'Radiology',
            'name_th' => 'รังสีวิทยา',
        ]
        ];

        foreach($specialist_data as $data){
            Specialist::create($data);
        }
    }
}
