<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getDashboardData(): JsonResponse
    {
        try {
            $tables = DB::select('SHOW TABLES');
            $database = env('DB_DATABASE');
            $key = "Tables_in_{$database}";
            $excluded = [
                'cache',
                'cache_locks',
                'failed_jobs',
                'job_batches',
                'jobs',
                'migrations',
                'sessions',
                'password_reset_tokens'
            ];
            $data = [];
            foreach ($tables as $table) {
                $tableName = $table->$key;
                if (in_array($tableName, $excluded)) {
                    continue;
                }
                $count = DB::table($tableName)->count();
                $data[] = [
                    'table' => $tableName,
                    'count' => $count
                ];
            }
            return response()->json([
                'status' => true,
                'message' => 'Successfully get dashboard data',
                'data' => [
                    'table_statistic' => $data
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
