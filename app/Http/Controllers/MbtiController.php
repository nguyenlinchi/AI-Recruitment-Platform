<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\JobPosting;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MbtiController extends Controller
{
    // Trang giới thiệu MBTI
    public function home()
    {
        return view('candidate.career.mbti');
    }

    // Trang làm bài test
    // Trang làm bài test
    public function index()
    {
        $questions = [


            [
                'question' => 'Bạn cảm thấy có năng lượng hơn khi?',
                'a' => 'Ở cùng nhiều người',
                'b' => 'Ở một mình',
                'typeA' => 'E',
                'typeB' => 'I'
            ],

            [
                'question' => 'Cuối tuần bạn thích?',
                'a' => 'Đi chơi với bạn bè',
                'b' => 'Ở nhà thư giãn',
                'typeA' => 'E',
                'typeB' => 'I'
            ],

            [
                'question' => 'Trong cuộc trò chuyện bạn thường?',
                'a' => 'Chủ động nói trước',
                'b' => 'Lắng nghe nhiều hơn',
                'typeA' => 'E',
                'typeB' => 'I'
            ],

            [
                'question' => 'Bạn thích môi trường?',
                'a' => 'Sôi động',
                'b' => 'Yên tĩnh',
                'typeA' => 'E',
                'typeB' => 'I'
            ],

            /*
            |--------------------------------------------------------------------------
            | S - N
            |--------------------------------------------------------------------------
            */

            [
                'question' => 'Bạn thường chú ý?',
                'a' => 'Chi tiết thực tế',
                'b' => 'Ý tưởng tương lai',
                'typeA' => 'S',
                'typeB' => 'N'
            ],

            [
                'question' => 'Bạn thích công việc?',
                'a' => 'Rõ ràng cụ thể',
                'b' => 'Sáng tạo đổi mới',
                'typeA' => 'S',
                'typeB' => 'N'
            ],

            [
                'question' => 'Bạn tin vào?',
                'a' => 'Kinh nghiệm',
                'b' => 'Trực giác',
                'typeA' => 'S',
                'typeB' => 'N'
            ],

            [
                'question' => 'Bạn thích học?',
                'a' => 'Ví dụ thực tế',
                'b' => 'Lý thuyết ý tưởng',
                'typeA' => 'S',
                'typeB' => 'N'
            ],

            /*
            |--------------------------------------------------------------------------
            | T - F
            |--------------------------------------------------------------------------
            */

            [
                'question' => 'Khi quyết định bạn dựa vào?',
                'a' => 'Logic',
                'b' => 'Cảm xúc',
                'typeA' => 'T',
                'typeB' => 'F'
            ],

            [
                'question' => 'Bạn đánh giá người khác qua?',
                'a' => 'Năng lực',
                'b' => 'Sự chân thành',
                'typeA' => 'T',
                'typeB' => 'F'
            ],

            [
                'question' => 'Bạn ưu tiên?',
                'a' => 'Công bằng',
                'b' => 'Hòa hợp',
                'typeA' => 'T',
                'typeB' => 'F'
            ],

            [
                'question' => 'Khi tranh luận bạn?',
                'a' => 'Dùng lý lẽ',
                'b' => 'Quan tâm cảm xúc',
                'typeA' => 'T',
                'typeB' => 'F'
            ],

            /*
            |--------------------------------------------------------------------------
            | J - P
            |--------------------------------------------------------------------------
            */

            [
                'question' => 'Bạn thích?',
                'a' => 'Lập kế hoạch',
                'b' => 'Linh hoạt',
                'typeA' => 'J',
                'typeB' => 'P'
            ],

            [
                'question' => 'Khi làm việc bạn?',
                'a' => 'Đúng deadline',
                'b' => 'Tùy hứng',
                'typeA' => 'J',
                'typeB' => 'P'
            ],

            [
                'question' => 'Bạn thích cuộc sống?',
                'a' => 'Có kế hoạch rõ ràng',
                'b' => 'Ngẫu hứng',
                'typeA' => 'J',
                'typeB' => 'P'
            ],

            [
                'question' => 'Bạn thường lên kế hoạch?',
                'a' => 'Chi tiết',
                'b' => 'Tùy tình huống',
                'typeA' => 'J',
                'typeB' => 'P'
            ],

        ];

        return view('candidate.career.test', compact('questions'));
    }

    // Xử lý kết quả
    public function submit(Request $request)
    {
        $answers = $request->answers;

        $scores = [
            'E' => 0,
            'I' => 0,
            'S' => 0,
            'N' => 0,
            'T' => 0,
            'F' => 0,
            'J' => 0,
            'P' => 0,
        ];

        if ($answers) {

            foreach ($answers as $answer) {

                if (isset($scores[$answer])) {
                    $scores[$answer]++;
                }
            }
        }

        $result = '';

        $result .= ($scores['E'] >= $scores['I']) ? 'E' : 'I';
        $result .= ($scores['S'] >= $scores['N']) ? 'S' : 'N';
        $result .= ($scores['T'] >= $scores['F']) ? 'T' : 'F';
        $result .= ($scores['J'] >= $scores['P']) ? 'J' : 'P';

        // DATA 16 MBTI
        
        $mbtiData = [

            'ISTJ' => [
                'name' => 'Người trách nhiệm',
                'description' => 'Kỷ luật, logic và đáng tin cậy.',
                'strengths' => [
                    'Làm việc có tổ chức',
                    'Tinh thần trách nhiệm cao',
                    'Đúng deadline'
                ],
                'weaknesses' => [
                    'Khá cứng nhắc',
                    'Khó thích nghi nhanh'
                ],
                'career' => [
                    'Kế toán',
                    'Ngân hàng',
                    'Kiểm toán'
                ],
                'jobs' => [
                    'Kế toán viên',
                    'Chuyên viên tài chính',
                    'Nhân viên hành chính'
                ],
                'work_env' => 'Môi trường ổn định và có quy trình rõ ràng.'
            ],

            'ISFJ' => [
                'name' => 'Người bảo vệ',
                'description' => 'Chu đáo, tận tâm và luôn quan tâm người khác.',
                'strengths' => [
                    'Kiên nhẫn',
                    'Tốt bụng',
                    'Có trách nhiệm'
                ],
                'weaknesses' => [
                    'Ngại thay đổi',
                    'Hay lo lắng'
                ],
                'career' => [
                    'Giáo viên',
                    'Y tá',
                    'Nhân sự'
                ],
                'jobs' => [
                    'Giáo viên',
                    'Điều dưỡng',
                    'HR Executive'
                ],
                'work_env' => 'Môi trường thân thiện và ổn định.'
            ],

            'INFJ' => [
                'name' => 'Người che chở',
                'description' => 'Sâu sắc, giàu trực giác và thích giúp đỡ người khác.',
                'strengths' => [
                    'Đồng cảm',
                    'Sáng tạo',
                    'Tư duy sâu sắc'
                ],
                'weaknesses' => [
                    'Dễ áp lực',
                    'Ít chia sẻ cảm xúc'
                ],
                'career' => [
                    'Tâm lý học',
                    'Nhà văn',
                    'Giáo dục'
                ],
                'jobs' => [
                    'Chuyên viên tâm lý',
                    'Content Writer',
                    'Mentor'
                ],
                'work_env' => 'Môi trường ý nghĩa và nhân văn.'
            ],

            'INTJ' => [
                'name' => 'Nhà khoa học',
                'description' => 'Thông minh, chiến lược và logic.',
                'strengths' => [
                    'Tư duy chiến lược',
                    'Phân tích tốt',
                    'Lập kế hoạch dài hạn'
                ],
                'weaknesses' => [
                    'Ít bộc lộ cảm xúc',
                    'Khó làm việc với người thiếu logic'
                ],
                'career' => [
                    'Developer',
                    'Data Analyst',
                    'AI Engineer'
                ],
                'jobs' => [
                    'Backend Developer',
                    'Data Analyst',
                    'System Architect'
                ],
                'work_env' => 'Môi trường công nghệ và sáng tạo.'
            ],

            'ISTP' => [
                'name' => 'Nhà kỹ thuật',
                'description' => 'Thực tế, linh hoạt và thích khám phá.',
                'strengths' => [
                    'Xử lý vấn đề tốt',
                    'Thích nghi nhanh',
                    'Thực tế'
                ],
                'weaknesses' => [
                    'Ít biểu lộ cảm xúc',
                    'Dễ chán'
                ],
                'career' => [
                    'Kỹ sư',
                    'IT',
                    'Cơ khí'
                ],
                'jobs' => [
                    'IT Support',
                    'Kỹ sư phần mềm',
                    'Kỹ thuật viên'
                ],
                'work_env' => 'Môi trường thực hành và linh hoạt.'
            ],

            'ISFP' => [
                'name' => 'Người nghệ sĩ',
                'description' => 'Nhẹ nhàng, sáng tạo và yêu cái đẹp.',
                'strengths' => [
                    'Sáng tạo',
                    'Tinh tế',
                    'Thân thiện'
                ],
                'weaknesses' => [
                    'Khó quyết định',
                    'Dễ bị ảnh hưởng cảm xúc'
                ],
                'career' => [
                    'Thiết kế',
                    'Nghệ thuật',
                    'Thời trang'
                ],
                'jobs' => [
                    'Graphic Designer',
                    'Photographer',
                    'Fashion Designer'
                ],
                'work_env' => 'Môi trường tự do sáng tạo.'
            ],

            'INFP' => [
                'name' => 'Người lý tưởng',
                'description' => 'Giàu cảm xúc và giàu trí tưởng tượng.',
                'strengths' => [
                    'Đồng cảm',
                    'Sáng tạo',
                    'Lý tưởng'
                ],
                'weaknesses' => [
                    'Dễ suy nghĩ nhiều',
                    'Khó chịu áp lực'
                ],
                'career' => [
                    'Writer',
                    'Designer',
                    'Content Creator'
                ],
                'jobs' => [
                    'Content Writer',
                    'UI Designer',
                    'Copywriter'
                ],
                'work_env' => 'Môi trường sáng tạo và tự do.'
            ],

            'INTP' => [
                'name' => 'Nhà tư duy',
                'description' => 'Ham học hỏi và thích phân tích.',
                'strengths' => [
                    'Logic',
                    'Sáng tạo',
                    'Phân tích tốt'
                ],
                'weaknesses' => [
                    'Ít giao tiếp',
                    'Hay trì hoãn'
                ],
                'career' => [
                    'Lập trình',
                    'Nghiên cứu',
                    'Khoa học dữ liệu'
                ],
                'jobs' => [
                    'Developer',
                    'Researcher',
                    'Data Scientist'
                ],
                'work_env' => 'Môi trường học hỏi và đổi mới.'
            ],

            'ESTP' => [
                'name' => 'Người hành động',
                'description' => 'Năng động và thích trải nghiệm.',
                'strengths' => [
                    'Nhanh nhẹn',
                    'Tự tin',
                    'Giao tiếp tốt'
                ],
                'weaknesses' => [
                    'Thiếu kiên nhẫn',
                    'Dễ hành động bốc đồng'
                ],
                'career' => [
                    'Kinh doanh',
                    'Sales',
                    'Du lịch'
                ],
                'jobs' => [
                    'Sales Executive',
                    'Tour Guide',
                    'Business Development'
                ],
                'work_env' => 'Môi trường năng động và cạnh tranh.'
            ],

            'ESFP' => [
                'name' => 'Người trình diễn',
                'description' => 'Hoạt bát, vui vẻ và thích kết nối.',
                'strengths' => [
                    'Thân thiện',
                    'Nhiệt tình',
                    'Giao tiếp tốt'
                ],
                'weaknesses' => [
                    'Dễ mất tập trung',
                    'Ngại áp lực'
                ],
                'career' => [
                    'Giải trí',
                    'Marketing',
                    'Truyền thông'
                ],
                'jobs' => [
                    'MC',
                    'TikToker',
                    'Marketing Executive'
                ],
                'work_env' => 'Môi trường sáng tạo và vui vẻ.'
            ],

            'ENFP' => [
                'name' => 'Người truyền cảm hứng',
                'description' => 'Nhiệt huyết và sáng tạo.',
                'strengths' => [
                    'Giao tiếp tốt',
                    'Nhiều ý tưởng',
                    'Truyền cảm hứng'
                ],
                'weaknesses' => [
                    'Dễ chán',
                    'Thiếu tập trung'
                ],
                'career' => [
                    'Marketing',
                    'MC',
                    'Truyền thông'
                ],
                'jobs' => [
                    'Marketing Executive',
                    'Content Creator',
                    'MC'
                ],
                'work_env' => 'Môi trường năng động và sáng tạo.'
            ],

            'ENTP' => [
                'name' => 'Nhà tranh luận',
                'description' => 'Thông minh, linh hoạt và thích thử thách.',
                'strengths' => [
                    'Sáng tạo',
                    'Tranh luận tốt',
                    'Thích đổi mới'
                ],
                'weaknesses' => [
                    'Dễ mất hứng',
                    'Không thích quy tắc'
                ],
                'career' => [
                    'Startup',
                    'Luật',
                    'Kinh doanh'
                ],
                'jobs' => [
                    'Lawyer',
                    'Startup Founder',
                    'Business Strategist'
                ],
                'work_env' => 'Môi trường đổi mới và linh hoạt.'
            ],

            'ESTJ' => [
                'name' => 'Nhà điều hành',
                'description' => 'Lãnh đạo, thực tế và quyết đoán.',
                'strengths' => [
                    'Tổ chức tốt',
                    'Lãnh đạo tốt',
                    'Kỷ luật'
                ],
                'weaknesses' => [
                    'Khá cứng nhắc',
                    'Ít linh hoạt'
                ],
                'career' => [
                    'Quản lý',
                    'Kinh doanh',
                    'Điều hành'
                ],
                'jobs' => [
                    'Project Manager',
                    'CEO',
                    'Operations Manager'
                ],
                'work_env' => 'Môi trường chuyên nghiệp và rõ ràng.'
            ],

            'ESFJ' => [
                'name' => 'Người chăm sóc',
                'description' => 'Hòa đồng và thích hỗ trợ người khác.',
                'strengths' => [
                    'Quan tâm người khác',
                    'Hợp tác tốt',
                    'Thân thiện'
                ],
                'weaknesses' => [
                    'Dễ bị ảnh hưởng cảm xúc',
                    'Sợ bị đánh giá'
                ],
                'career' => [
                    'HR',
                    'Giáo dục',
                    'Dịch vụ'
                ],
                'jobs' => [
                    'HR Staff',
                    'Customer Service',
                    'Teacher'
                ],
                'work_env' => 'Môi trường teamwork và thân thiện.'
            ],

            'ENFJ' => [
                'name' => 'Người dẫn dắt',
                'description' => 'Truyền cảm hứng và có khả năng lãnh đạo.',
                'strengths' => [
                    'Lãnh đạo',
                    'Đồng cảm',
                    'Truyền động lực'
                ],
                'weaknesses' => [
                    'Hay lo cho người khác',
                    'Dễ áp lực'
                ],
                'career' => [
                    'Coaching',
                    'Giáo dục',
                    'Quản lý'
                ],
                'jobs' => [
                    'Coach',
                    'Team Leader',
                    'HR Manager'
                ],
                'work_env' => 'Môi trường phát triển con người.'
            ],

            'ENTJ' => [
                'name' => 'Nhà lãnh đạo',
                'description' => 'Quyết đoán và có tố chất lãnh đạo.',
                'strengths' => [
                    'Lãnh đạo tốt',
                    'Tư duy chiến lược',
                    'Quyết đoán'
                ],
                'weaknesses' => [
                    'Thiếu kiên nhẫn',
                    'Khá áp lực với người khác'
                ],
                'career' => [
                    'CEO',
                    'Project Manager',
                    'Business Analyst'
                ],
                'jobs' => [
                    'Manager',
                    'Leader',
                    'Business Development'
                ],
                'work_env' => 'Môi trường cạnh tranh và phát triển.'
            ]
        ];
        // fallback nếu chưa có dữ liệu
        if (!isset($mbtiData[$result])) {

            $mbtiData[$result] = [

                'name' => 'Nhóm tính cách đặc biệt',

                'description' => 'Bạn có nhiều tiềm năng phát triển.',

                'strengths' => [
                    'Khả năng thích nghi',
                    'Tư duy linh hoạt'
                ],

                'weaknesses' => [
                    'Dễ phân vân'
                ],

                'career' => [
                    'Công nghệ',
                    'Kinh doanh',
                    'Thiết kế'
                ],

                'jobs' => [
                    'Developer',
                    'Designer',
                    'Marketing'
                ],

                'work_env' => 'Môi trường linh hoạt và sáng tạo.'
            ];
        }

        $data = $mbtiData[$result];

        return view('candidate.career.result', compact(
            'result',
            'data',
            'scores'
        ));
    }
   public function filterJobsByCareer(Request $request, $keyword)
    {
        $category = Category::where(
            'category_name',
            'LIKE',
            '%' . $keyword . '%'
        )->first();

        if ($category) {

            $jobs = $category->jobs()
                ->with(['employer', 'salary', 'category'])
                ->get();

        } else {

            $jobs = JobPosting::where(
                    'job_title',
                    'LIKE',
                    '%' . $keyword . '%'
                )
                ->with(['employer', 'salary', 'category'])
                ->get();
        }

        // Tính AI matching
        foreach ($jobs as $job) {

            $match = 60;

            // Match title
            if (stripos($job->job_title, $keyword) !== false) {
                $match += 25;
            }

            // Match category
            if (
                $job->category &&
                stripos($job->category->category_name, $keyword) !== false
            ) {
                $match += 10;
            }

            // Random nhẹ
            $match += rand(1, 5);

            $job->match_percent = min($match, 99);
        }

        // Sort theo %
        $jobs = $jobs->sortByDesc('match_percent');
        $topMatch = $jobs->first();

        // PAGINATE THỦ CÔNG
        $perPage = 10;

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentItems = $jobs->slice(
            ($currentPage - 1) * $perPage,
            $perPage
        )->values();

        $paginatedJobs = new LengthAwarePaginator(
            $currentItems,
            $jobs->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view(
        'candidate.career.job_list',
        [
            'jobs' => $paginatedJobs,
            'keyword' => $keyword,
            'topMatch' => $topMatch
        ]
    );
    }
}