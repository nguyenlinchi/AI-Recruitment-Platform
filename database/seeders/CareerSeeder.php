<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    // 🔥 CATEGORY
    DB::table('career_categories')->insert([
        ['category_id'=>1,'name'=>'Định hướng','slug'=>'dinh-huong'],
        ['category_id'=>2,'name'=>'Bí kíp','slug'=>'bi-kip'],
        ['category_id'=>3,'name'=>'Kỹ năng','slug'=>'ky-nang'],
        ['category_id'=>4,'name'=>'Xu hướng','slug'=>'xu-huong'],
    ]);

    // 🔥 TAG
    DB::table('tags')->insert([
        ['tag_id'=>1,'name'=>'CV'],
        ['tag_id'=>2,'name'=>'Phỏng vấn'],
        ['tag_id'=>3,'name'=>'Kỹ năng mềm'],
        ['tag_id'=>4,'name'=>'IT'],
        ['tag_id'=>5,'name'=>'Marketing'],
    ]);

    // 🔥 GUIDES (NHIỀU BÀI)
    DB::table('career_guides')->insert([

        [
            'guide_id'=>1,
            'title'=>'Ngành IT là gì?',
            'slug'=>'nganh-it-la-gi',
            'summary'=>'Tổng quan về ngành IT',
            'thumbnail'=>'https://via.placeholder.com/600x300',
            'account_id'=>1,
            'category_id'=>1,
            'is_featured'=>1
        ],

        [
            'guide_id'=>2,
            'title'=>'Cách viết CV chuẩn cho sinh viên',
            'slug'=>'cach-viet-cv',
            'summary'=>'Hướng dẫn viết CV chuyên nghiệp',
            'thumbnail'=>'https://via.placeholder.com/600x300',
            'account_id'=>1,
            'category_id'=>2,
            'is_featured'=>1
        ],

        [
            'guide_id'=>3,
            'title'=>'Top câu hỏi phỏng vấn phổ biến',
            'slug'=>'cau-hoi-phong-van',
            'summary'=>'Chuẩn bị tốt khi đi phỏng vấn',
            'thumbnail'=>'https://via.placeholder.com/600x300',
            'account_id'=>1,
            'category_id'=>2,
            'is_featured'=>0
        ],

        [
            'guide_id'=>4,
            'title'=>'Kỹ năng giao tiếp trong công việc',
            'slug'=>'ky-nang-giao-tiep',
            'summary'=>'Cải thiện kỹ năng mềm',
            'thumbnail'=>'https://via.placeholder.com/600x300',
            'account_id'=>1,
            'category_id'=>3,
            'is_featured'=>0
        ],

        [
            'guide_id'=>5,
            'title'=>'Ngành Marketing có còn hot?',
            'slug'=>'marketing-2026',
            'summary'=>'Xu hướng nghề Marketing',
            'thumbnail'=>'https://via.placeholder.com/600x300',
            'account_id'=>1,
            'category_id'=>4,
            'is_featured'=>0
        ],
    ]);

    // 🔥 SECTIONS (NHIỀU NỘI DUNG CHO MỖI BÀI)
    DB::table('career_guide_sections')->insert([

        // ===== BÀI 1 =====
        ['guide_id'=>1,'title'=>'IT là gì?','content'=>'Ngành IT là lĩnh vực công nghệ thông tin...','sort_order'=>1],
        ['guide_id'=>1,'title'=>'Các vị trí IT','content'=>'<ul><li>Developer</li><li>Tester</li><li>BA</li></ul>','sort_order'=>2],
        ['guide_id'=>1,'title'=>'Mức lương IT','content'=>'Mức lương IT rất cao...','sort_order'=>3],

        // ===== BÀI 2 =====
        ['guide_id'=>2,'title'=>'CV là gì?','content'=>'CV là hồ sơ xin việc...','sort_order'=>1],
        ['guide_id'=>2,'title'=>'Cách viết CV','content'=>'<ul><li>Ngắn gọn</li><li>Rõ ràng</li></ul>','sort_order'=>2],

        // ===== BÀI 3 =====
        ['guide_id'=>3,'title'=>'Câu hỏi thường gặp','content'=>'Bạn hãy giới thiệu bản thân...','sort_order'=>1],
        ['guide_id'=>3,'title'=>'Cách trả lời','content'=>'Tự tin và trung thực...','sort_order'=>2],

        // ===== BÀI 4 =====
        ['guide_id'=>4,'title'=>'Giao tiếp là gì?','content'=>'Giao tiếp là kỹ năng quan trọng...','sort_order'=>1],
        ['guide_id'=>4,'title'=>'Cách cải thiện','content'=>'Luyện tập mỗi ngày...','sort_order'=>2],

        // ===== BÀI 5 =====
        ['guide_id'=>5,'title'=>'Marketing hiện nay','content'=>'Marketing đang phát triển mạnh...','sort_order'=>1],
        ['guide_id'=>5,'title'=>'Xu hướng mới','content'=>'Digital marketing lên ngôi...','sort_order'=>2],
    ]);

    // 🔥 TAG RELATION
    DB::table('career_guide_tag')->insert([
        ['guide_id'=>1,'tag_id'=>4],
        ['guide_id'=>2,'tag_id'=>1],
        ['guide_id'=>2,'tag_id'=>2],
        ['guide_id'=>3,'tag_id'=>2],
        ['guide_id'=>4,'tag_id'=>3],
        ['guide_id'=>5,'tag_id'=>5],
    ]);
}
}
