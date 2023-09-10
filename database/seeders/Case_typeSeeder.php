<?php

namespace Database\Seeders;

use App\Models\Casetype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Case_typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $case_type_data = [[
            'casetype_id' => 'RD1001',
            'casetype_name' => 'การตรวจวินิฉัย'
        ],
        [
            'casetype_id' => 'OD1001',
            'casetype_name' => 'การอุดฟัน'
        ],
        [
            'casetype_id' => 'PK1001',
            'casetype_name' => 'การอุดฟัน (สำหรับเด็ก)'
        ],
        [
            'casetype_id' => 'OD1002',
            'casetype_name' => 'การขัดฟันและการขูดหินปูน'
        ],
        [   'casetype_id' => 'PK1002',
            'casetype_name' => 'การขัดฟันและขูดหินปูน (สำหรับเด็ก)'
        ],
        [
            'casetype_id' => 'OD1003',
            'casetype_name' => 'ฟอกสีฟัน'
        ],
        [
            'casetype_id' => 'PD1001',
            'casetype_name' => 'ครอบฟันและสะพานฟัน'
        ],
        [
            'casetype_id' => 'OD1004',
            'casetype_name' => 'วีเนียร์ หรือการเคลือบผิวฟัน'
        ],
        [
            'casetype_id' => 'PD1002',
            'casetype_name' => 'การอุดฟันด้วยวัสดุเรซิน'
        ],
        [
            'casetype_id' => 'PD1003',
            'casetype_name' => 'การตกแต่งและบูรณะฟันด้วยวัสดุเรซิน'
        ],
        [
            'casetype_id' => 'PD1004',
            'casetype_name' => 'การปลูกรากฟันเทียม'
        ],
        [
            'casetype_id' => 'PD1005',
            'casetype_name' => 'การรักษารากฟัน'
        ],
        [
            'casetype_id' => 'PK1003',
            'casetype_name' => 'การใช้เครื่องมือรักษาช่องว่างของฟัน'
        ],
        [
            'casetype_id' => 'PK1004',
            'casetype_name' => 'การควบคุมและปรับปรุงพฤติกรรมของเด็ก'
        ],
        [
            'casetype_id' => 'OT1001',
            'casetype_name' => 'จัดฟันโลหะ'
        ],
        [
            'casetype_id' => 'OT1002',
            'casetype_name' => 'จัดฟันสี'
        ],
        [
            'casetype_id' => 'OT1003',
            'casetype_name' => 'จัดฟันใส'
        ],
        [
            'casetype_id' => 'OT1004',
            'casetype_name' => 'จัดฟันด้านใน'
        ],
        [
            'casetype_id' => 'OT1005',
            'casetype_name' => 'จัดฟันด้านทั่วไป'
        ],
        [
            'casetype_id' => 'PT1001',
            'casetype_name' => 'การเกลารากฟัน'
        ],
        [
            'casetype_id' => 'PT1002',
            'casetype_name' => 'การศัลยกรรมตกแต่งเหงือก'
        ],
        [
            'casetype_id' => 'PT1003',
            'casetype_name' => 'การศัลยกรรมเพิ่มเหงือก (แก้ปัญหาเหงือกร่น)'
        ],
        [
            'casetype_id' => 'PT1004',
            'casetype_name' => 'การศัลยกรรมเหงือก (เพื่อปรับความยาวของฟัน)'
        ],
        [
            'casetype_id' => 'OS1001',
            'casetype_name' => 'ถอนฟัน'
        ],
        [
            'casetype_id' => 'OS1002',
            'casetype_name' => 'ผ่าฟันคุด'
        ],
        [
            'casetype_id' => 'OS1003',
            'casetype_name' => 'การปลูกรากฟันเทียม'
        ],
        [
            'casetype_id' => 'OS1004',
            'casetype_name' => 'การปลูกถ่ายกระดูก'
        ],
        [
            'casetype_id' => 'OS1005',
            'casetype_name' => 'การผ่าตัดเพื่อจัดแต่งขากรรไกรร่วมกับการจัดฟัน'
        ],
        [
            'casetype_id' => 'PD1006',
            'casetype_name' => 'การเคลือบหลุมร่องฟัน และ เคลือบฟลูออไรด์'
        ],
        [
            'casetype_id' => 'PD1007',
            'casetype_name' => 'การป้องกันฟันผุ'
        ],
        [
            'casetype_id' => 'OC1001',
            'casetype_name' => 'การให้คำปรึกษาด้านโภชนาการที่เหมาะสม'
        ],
        [
            'casetype_id' => 'OM1001',
            'casetype_name' => 'การแนะนำเกี่ยวกับสุขอนามัยภายในช่องปาก'
        ],
        ];
        
        foreach($case_type_data as $data){
            Casetype::create($data);
        }
    }
}
