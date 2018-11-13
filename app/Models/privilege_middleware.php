<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class privilege_middleware extends Model
{
    //
    public function get_path()
    {
        $privilege = DB::select('
                            select GROUP_CONCAT(c.url_path) name
                                from shop_admin_role a
                                LEFT JOIN shop_privilege_role b on a.role_id = b.role_id
                                LEFT JOIN shop_privilege c on c.id = b.privilege_id
                                WHERE a.admin_id = '.session('user_id').'
                                GROUP BY a.admin_id
        ');
        return $path = $privilege[0]->name;
        // var_dump($privilege);die;
                             
    }

    public function getRole()
    {
        // var_dump(session('user_id'));die;
        $data = DB::select('
                        select a.admin_id,GROUP_CONCAT(a.role_id) role_id 
                        from shop_admin_role a 
                        where a.admin_id = '. session('user_id') .' group by a.admin_id' );
                        // var_dump($data);die;
        return $data[0]->role_id;
    }

}
