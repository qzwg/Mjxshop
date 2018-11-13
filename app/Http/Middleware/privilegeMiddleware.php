<?php

namespace App\Http\Middleware;
error_reporting( E_ALL&~E_NOTICE );
use Closure;
use App\Models\privilege_middleware;
class privilegeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //前置中间件
        //根据登陆信息去表中获取privilege path，点击每一个路由，都要获取他的url，判断path中是否存在
        //存在，即可跳转，不存在，提示信息，无权访问

        if(session('user_id'))
        {
            $model = new privilege_middleware;
            $url = $model->get_path();
            $role = $model->getRole();
            // var_dump(session('user_id'));
            // var_dump($role);die;
            if(strpos($role,'1')===false)
            {
                //白名单
                $fillable = ',system';
                $path = $url.$fillable;
                //获取url地址参数，判断
                $getRequest = $_SERVER['PATH_INFO'];
                $trimRequest = trim($getRequest,'/');
                // var_dump($trimRequest);
                // var_dump($path);
                // var_dump($trimRequest);
                if(stripos($path,$trimRequest) === false)
                {
                    die("无权限");
                }
            }
            else
                return $next($request);
        }
        else
            return redirect('admin');

        return $next($request);
        
        
    }
}
