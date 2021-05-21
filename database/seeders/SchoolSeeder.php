<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeeder extends Seeder
{
    /**
     * schoolsテーブルに初期データを挿入
     *
     * @return void
     */
    public function run()
    {
        $data = [
           [
                'school_name' => 'DMM WEBCAMP',
                'school_url' => 'https://web-camp.io/',
                'features' => [
                    '目的に合わせて3つのコースが設定されている',
                    '専門技術コースは厚労省指定の給付金制度の対象講座で条件を満たすと最大70%が支給',
                ],
           ],
           [
                'school_name' => 'TECH CAMP',
                'school_url' => 'https://tech-camp.in/',
                'features' => [
                    'WEBデザイナー用のコースがある',
                    'オンライン・通学から選べる',
                ],
           ],
           [
                'school_name' => 'SAMURAI ENGINEER',
                'school_url' => 'https://www.sejuku.net/',
                'features' => [
                    '目的に合わせて6つのコースがある',
                    'AIを学べるコースがある',
                    '転職コースは転職成功で受講料無料',
                ],
           ],
           [
                'school_name' => 'Tech Academy',
                'school_url' => 'https://techacademy.jp/',
                'features' => [
                    'プログラミング15コース、デザイン7コース、マネジメント2コースなどコースが豊富',
                    'オンラインで完結するカリキュラム',
                    'メンターは全員が現役エンジニア'
                ],
           ],
           [
                'school_name' => 'GEEK JOB',
                'school_url' => 'https://learn.geekjob.jp/',
                'features' => [
                    'スピード転職コースはJavaとインフラを学習し、受講料無料'
                ],
           ],
           [
                'school_name' => 'Raise Tech',
                'school_url' => 'https://raise-tech.net/',
                'features' => [
                    '現場主義にこだわった実践的な学習をサポート',
                    '月単価80万円以上の現役エンジニアが講師',
                    '質疑応答や授業が無期限で受けられる',
                ],
           ],
           [
                'school_name' => 'RUNTEQ',
                'school_url' => 'https://runteq.jp/',
                'features' => [
                    '主にRailsを学習',
                    '800~1000時間の学習ができる'
                ],
           ],
           [
                'school_name' => 'POTEPAN CAMP',
                'school_url' => 'https://camp.potepan.com/',
                'features' => [
                    '主にRailsを学習',
                    'RailsキャリアコースにはMacのPCが必要',
                ],
            ],
           [
                'school_name' => 'COACHTECH',
                'school_url' => 'https://coachtech.site/',
                'features' => [
                    '転職サービスであるレバテックと連携',
                ],
            ],
           [
                'school_name' => 'CodeCamp',
                'school_url' => 'https://codecamp.jp/',
                'features' => [
                    'iPhone/Androidアプリ開発の学べる',
                    'Webデザインを学習するコースがある',
                ],
            ],
        ];

        foreach($data as $school_form) {
            School::create($school_form);
        }
    }
}
