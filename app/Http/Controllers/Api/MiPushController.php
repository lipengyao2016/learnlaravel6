<?php
/**
 * Created by PhpStorm.
 * User: user_1234
 * Date: 2019/7/6
 * Time: 17:33
 */
namespace App\Http\Controllers\Api;

use App\Events\OrderShipped;
use App\Http\facade\MyFooFacade;
use App\Jobs\ProcessOrder;
use App\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Validator;
use Laravel\Passport\Passport;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;





class MiPushController extends Controller
{

    public $successStatus = 200;

    private $http;
    public function __construct(Client $client)
    {
        $this->http = $client;
    }


    /**
 * login api
 *
 * @return \Illuminate\Http\Response
 */
    public function android_msg_push(Request $request)
    {
        $data = $request->all();


        $aliasList = $data['uid'];
        $title = $data['title'];
        $desc = $data['desc'];
        $content = $data['content'];


        Log::debug(__METHOD__.' $data:'.json_encode($data));
        return AndroidMsgPush::alias_push($aliasList,$title,$desc,$content);
    }



    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function ios_msg_push(Request $request)
    {
        $data = $request->all();


        $aliasList = $data['uid'];
        $title = $data['title'];
        $desc = $data['desc'];
        $content = $data['content'];


        Log::debug(__METHOD__.' $data:'.json_encode($data));
        return IosMsgPush::alias_push($aliasList,$title,$desc,$content);
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function all_msg_push(Request $request)
    {
        $data = $request->all();


        $aliasList = $data['uid'];
        $title = $data['title'];
        $desc = $data['desc'];
        $content = $data['content'];


        Log::debug(__METHOD__.' $data:'.json_encode($data));
        $androidPushRet =  AndroidMsgPush::alias_push($aliasList,$title,$desc,$content);
        $iosPushRet =  IosMsgPush::alias_push($aliasList,$title,$desc,$content);
        return ['androidPushRet' => $androidPushRet,'iosPushRet' =>$iosPushRet];
    }


}
