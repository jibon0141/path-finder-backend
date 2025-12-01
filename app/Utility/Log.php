<?php

namespace App\Utility;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\File;


class Log{

     public static function queryLog($file = "query")
    {
        gc_collect_cycles();
        if(file_exists(storage_path("/logs/$file.log")))
            @unlink(storage_path("/logs/$file.log"));
        $query_count=0;
        DB::listen(function($query) use (&$query_count,$file){
            $sql = self::formatQuery($query->bindings,$query->sql);
            File::append(
                storage_path("/logs/$file.log"),
                PHP_EOL. ++$query_count.'. '.$sql . PHP_EOL . 'Execution Time = '.  $query->time . PHP_EOL.'Date Time = '.  date('Y-m-d H:i:s') . PHP_EOL
            );

            $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
            foreach ($backtrace as $trace) {
                if(array_key_exists('file',$trace) && array_key_exists('line',$trace)){
                    if( strpos($trace['file'],'vendor')==false
                        && strpos($trace['file'],'Middleware')==false
                        && strpos($trace['file'],'public')==false
                        && strpos($trace['file'],'server')==false){
                        File::append(
                            storage_path("/logs/$file.log"),
                            $trace['file'] .' '.$trace['line'].PHP_EOL
                        );
                    }
                }
            }
        });
    }

    public static function formatQuery($bindings, $naked_sql){

        $parted = explode('?', $naked_sql);
        if (count($bindings) > 0) {
            $final = '';
            foreach ($parted as $key => $part) {

                if (next($parted)) {
                    $value = $bindings[$key];
                    if (is_string($value)) {
                        $final .= $part . "'" . $value . "'";
                    }elseif (is_object($value)){
                        $final .= $part . current( (Array)$value );
                    } else {

                        $final .= $part . $value;
                    }
                } else {
                    if (isset($bindings[$key])) {
                        $value = $bindings[$key];
                        if (is_string($value)) {
                            $final .= $part . "'" . $value . "'";
                        }elseif (is_object($value)){
                            $final .= $part . current( (Array)$value );
                        } else {

                            $final .= $part . $value;
                        }
                    } else {
                        $final .= $part;
                    }

                }

            }
            $sql = $final . ';';
        }else{
            $sql = $naked_sql;
        }
        return $sql;
    }
}