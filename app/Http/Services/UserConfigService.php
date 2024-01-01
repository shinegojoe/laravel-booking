<?php
namespace App\Http\Services;
use App\Utils\TableNameString;
use App\Models\UserConfig;
use Illuminate\Support\Facades\Log;

class UserConfigService {
    private $userConfigTable;
   

    public function findOneByUId(string $uId): UserConfig | null{
        $data = UserConfig::where('user_id', $uId)->first();
        return $data;
    }

    public function updateIsSyncCalendar(string $uId, bool $value) {
        Log::info($uId);
        Log::info($value);
        $userConfig = UserConfig::where('user_id', $uId)->update(['is_sync_calendar'=>$value]);
        return $userConfig;    
    
    }

    public function updateIsDefaultCoach(string $uId, bool $value) {
        UserConfig::where('user_id', $uId)->update(['is_default_coach'=>$value]);
    }



}
