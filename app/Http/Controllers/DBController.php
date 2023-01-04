<?php

namespace App\Http\Controllers;


use App\Models\Clientinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
// use Illuminate\Database\Schema\Blueprint;

class DBController extends Controller
{
    //

    public function createDB(Request $request)
    {
        if (Auth::check()) {
            $id = Auth::id();
            $data['user_id']=$id;
            $req = $request->all();
            $data['name'] = $req['name'];
            $data['email'] = $req['email'];
            $randomString = Str::random(10);
            $db = 'DB_Client_' . $randomString;
            $data['client_db_name']=strtolower($db);
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['created_at'] = date('Y-m-d H:i:s');
            $store_data = Clientinfo::insert($data);
            // return $store_data;
            // DB::getConnection()->statement('CREATE DATABASE :schema', ['schema' => $schemaName]);


            // Connection name = `mysql` for me, adjust as suits for you
            // DB::connection('mysql')->statement("CREATE DATABASE ?", [$this->database]);
            // Simply written
            if ($store_data) {
                // $t = DB::connection('mysql')->statement("CREATE DATABASE my_new_db_new");
                $db_created = DB::connection('mysql')->statement("CREATE DATABASE " . $data['client_db_name']);

                $db_name=strtolower($data['client_db_name']);
                if ($db_created) {

                //  self::configureConnectionByName($db_name);
                // $demo= DB::setDefaultConnection($db_name);
              $t=  Config::set("database.connections.mysql", [
                    "host" => "127.0.0.1",
                    "database" => $db_name,
                    "username" => "root",
                    "password" => ""
                ]);

             
                 Schema::connection($db_name)->create('test_table', function($table)
                    {
                        $table->id();
                        $table->string('user_id');
                        $table->string('client_name')->nullable();
                        $table->string('phone')->nullable();
                        $table->string('pan')->nullable();
                        $table->timestamps();
                    });
                 
                //    Artisan::call('migrate', array('database' =>   $db_name, 'path' => 'app/database/migrations/2023_01_04_082423_create_universal_tables_table'));
       
                //    DB::connection($db_name)->table('universaltables')->insert(['client_name' => 'New shoes',
                // "user_id"=>$id,"pan"=>"dsd","phone"=>"4343"]);
                }
            }
        } else {
            return 0;
        }
    }

   public static function configureConnectionByName($dbName)
    {
        // Just get access to the config. 
        $config = App::make('config');
    
        // Will contain the array of connections that appear in our database config file.
        $connections = $config->get('database.connections');
    
        // This line pulls out the default connection by key (by default it's `mysql`)
        $defaultConnection = $connections[$config->get('database.default')];
    
        // Now we simply copy the default connection information to our new connection.
        $newConnection = $defaultConnection;
        // Override the database name.
        $newConnection['database'] = $dbName;
    
        // This will add our new connection to the run-time configuration for the duration of the request.
     App::make('config')->set('database.connections.'.$dbName, $newConnection);
  
    
    }
}
