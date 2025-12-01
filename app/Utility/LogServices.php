<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;

class LogServices
{
    public function getLogFiles()
    {
        $logPath = storage_path('logs');
        $files = File::glob($logPath . '/laravel-*.log');
        
        $logFiles = collect($files)->map(function ($file) {
            $filename = basename($file);
            $date = str_replace(['laravel-', '.log'], '', $filename);
            return [
                'filename' => $filename,
                'date' => $date,
                'path' => $file,
                'size' => File::size($file)
            ];
        })->sortByDesc('date');
        
        // Add current date if not exists
        $currentDate = now()->format('Y-m-d');
        if (!$logFiles->where('date', $currentDate)->count()) {
            $logFiles->prepend([
                'filename' => 'laravel-' . $currentDate . '.log',
                'date' => $currentDate,
                'path' => storage_path('logs/laravel-' . $currentDate . '.log'),
                'size' => 0
            ]);
        }
        
        return $logFiles;
    }

    public function parseLogFile($filename, $search = null, $perPage = 50, $page = 1)
    {
        $logPath = storage_path('logs/' . $filename);
        
        if (!File::exists($logPath)) {
            return collect();
        }

        $content = File::get($logPath);
        $lines = explode("\n", $content);
        
        $logs = collect();
        
        foreach ($lines as $line) {
            if (empty(trim($line))) continue;
            
            if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] (\w+)\.(\w+): (.+)$/', $line, $matches)) {
                $logData = [
                    'timestamp' => $matches[1],
                    'environment' => $matches[2],
                    'level' => $matches[3],
                    'message' => $matches[4],
                    'parsed_data' => $this->parseJsonMessage($matches[4])
                ];
                
                if ($search && !$this->matchesSearch($logData, $search)) {
                    continue;
                }
                
                $logs->push($logData);
            }
        }
        
        return $this->paginateCollection($logs->reverse(), $perPage, $page);
    }

    private function parseJsonMessage($message)
    {
        $decoded = html_entity_decode($message);
        $jsonData = json_decode($decoded, true);
        
        return $jsonData ?: null;
    }

    private function matchesSearch($logData, $search)
    {
        $searchLower = strtolower($search);
        
        return str_contains(strtolower($logData['message']), $searchLower) ||
               str_contains(strtolower($logData['level']), $searchLower) ||
               ($logData['parsed_data'] && str_contains(strtolower(json_encode($logData['parsed_data'])), $searchLower));
    }

    private function paginateCollection($collection, $perPage, $page)
    {
        $total = $collection->count();
        $items = $collection->forPage($page, $perPage);
        
        return new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $page,
            ['path' => request()->url(), 'pageName' => 'page']
        );
    }
}