<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class showUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:show-user {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '第一引数にユーザーIDを指定する事で詳細画面の情報を表示します';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user_id = $this->argument('user_id');

        $user = User::find($user_id);

        if(!isset($user)){
            echo "ユーザーが見つかりませんでした";
            exit;

        }
        $formated_birthday = Carbon::parse($user->birth)->format("Y年m月d日");
        $age = User::getAge($user_id);
        $course = User::getCourse($user_id);

        $str = <<<EOM
■ユーザー詳細
名前 : {$user->name}
生年月日 : {$formated_birthday}
年度年齢 : {$age}歳
今年度の受診コース : {$course}

■受診記録一覧
受診年度 | 受診日 | 受診コース | 受診場所\n
EOM;

        echo $str;
        if($user->consultations->count()===0){
            echo "受診記録が見つかりませんでした";
        }else{
            foreach ($user->consultations as $item){
                echo Carbon::parse($item->consulted_at)->format('Y');
                echo " | ";
                echo $item->consulted_at;
                echo " | ";
                echo $item->course ==1?"1日人間ドック":"基本健診";
                echo " | ";
                echo $item->place;
                echo "\n";
            }
        }
    }
}
