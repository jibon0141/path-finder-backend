<?php
namespace App\Http\Controllers\backend\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use App\Traits\HandelErrorSuccess;

class SettingController extends Controller{

    use HandelErrorSuccess;

// Manage Settings Start Here
    public function manageSetting()
    {
        try{
            $envData = $this->getEnvData();
            Log::info("Settings Successfully Fetched");
            return view('admin.extends.setting.manage_setting', compact('envData'));
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return $this->genericError($e->getMessage(), 'Settings Fetch Failed!');
        }
    }
// Manage Settings End Here

// Update Settings Start Here
    public function updateSetting(Request $request)
    {
        try{
            $request->validate([
                'app_name' => 'required',
                'app_env' => 'required',
                'app_debug' => 'required',
                'app_url' => 'required|url',
                'db_host' => 'required',
                'db_port' => 'required',
                'db_database' => 'required',
                'db_username' => 'required',
                'mail_host' => 'nullable',
                'mail_port' => 'nullable',
                'mail_username' => 'nullable',
                'mail_from_address' => 'nullable|email',
            ]);

            $this->updateEnvFile($request->all());
            Log::info("Settings Successfully Updated");
            return $this->success('Settings Successfully Updated!');
        }
        catch(\Illuminate\Validation\ValidationException $e){
            Log::error("Validation Error in updateSetting");
            return $this->validationError($e, 'Please provide valid input.');
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return $this->genericError($e->getMessage(), 'Settings Update Failed!');
        }
    }
// Update Settings End Here

// Get Env Data Start Here
    private function getEnvData()
    {
        return [
            'app_name' => env('APP_NAME'),
            'app_env' => env('APP_ENV'),
            'app_debug' => env('APP_DEBUG'),
            'app_url' => env('APP_URL'),
            'db_host' => env('DB_HOST'),
            'db_port' => env('DB_PORT'),
            'db_database' => env('DB_DATABASE'),
            'db_username' => env('DB_USERNAME'),
            'mail_host' => env('MAIL_HOST'),
            'mail_port' => env('MAIL_PORT'),
            'mail_username' => env('MAIL_USERNAME'),
            'mail_from_address' => env('MAIL_FROM_ADDRESS'),
        ];
    }
// Get Env Data End Here

// Update Env File Start Here
    private function updateEnvFile($data)
    {
        $envFile = base_path('.env');
        $envContent = file_get_contents($envFile);

        $envUpdates = [
            'APP_NAME' => $data['app_name'],
            'APP_ENV' => $data['app_env'],
            'APP_DEBUG' => $data['app_debug'],
            'APP_URL' => $data['app_url'],
            'DB_HOST' => $data['db_host'],
            'DB_PORT' => $data['db_port'],
            'DB_DATABASE' => $data['db_database'],
            'DB_USERNAME' => $data['db_username'],
            'MAIL_HOST' => $data['mail_host'] ?? '',
            'MAIL_PORT' => $data['mail_port'] ?? '',
            'MAIL_USERNAME' => $data['mail_username'] ?? '',
            'MAIL_FROM_ADDRESS' => $data['mail_from_address'] ?? '',
        ];

        foreach ($envUpdates as $key => $value) {
            $pattern = "/^{$key}=.*/m";
            $replacement = "{$key}={$value}";
            
            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                $envContent .= "\n{$replacement}";
            }
        }

        file_put_contents($envFile, $envContent);
    }
// Update Env File End Here

// System Optimization Start Here
    public function systemOptimization()
    {
        try{
            Log::info("System Optimization Page Accessed");
            return view('admin.extends.setting.system_optimization');
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return $this->genericError($e->getMessage(), 'System Optimization Page Failed!');
        }
    }
// System Optimization End Here

// Clear Cache Start Here
    public function clearCache()
    {
        try{
            Artisan::call('cache:clear');
            Log::info("Cache Successfully Cleared");
            return $this->success('Cache Successfully Cleared!');
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return $this->genericError($e->getMessage(), 'Cache Clear Failed!');
        }
    }
// Clear Cache End Here

// Clear Config Start Here
    public function clearConfig()
    {
        try{
            Artisan::call('config:clear');
            Log::info("Config Cache Successfully Cleared");
            return $this->success('Config Cache Successfully Cleared!');
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return $this->genericError($e->getMessage(), 'Config Clear Failed!');
        }
    }
// Clear Config End Here

// Clear View Start Here
    public function clearView()
    {
        try{
            Artisan::call('view:clear');
            Log::info("View Cache Successfully Cleared");
            return $this->success('View Cache Successfully Cleared!');
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return $this->genericError($e->getMessage(), 'View Clear Failed!');
        }
    }
// Clear View End Here

// Clear Route Start Here
    public function clearRoute()
    {
        try{
            Artisan::call('route:clear');
            Log::info("Route Cache Successfully Cleared");
            return $this->success('Route Cache Successfully Cleared!');
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return $this->genericError($e->getMessage(), 'Route Clear Failed!');
        }
    }
// Clear Route End Here

// Optimize Application Start Here
    public function optimizeApp()
    {
        try{
            Artisan::call('optimize');
            Log::info("Application Successfully Optimized");
            return $this->success('Application Successfully Optimized!');
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return $this->genericError($e->getMessage(), 'Application Optimization Failed!');
        }
    }
// Optimize Application End Here

// Manage Logs Start Here
    public function manageLogs()
    {
        try{
            $logFiles = $this->getLogFiles();
            Log::info("Logs Successfully Fetched");
            return view('admin.extends.setting.manage_logs', compact('logFiles'));
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return $this->genericError($e->getMessage(), 'Logs Fetch Failed!');
        }
    }
// Manage Logs End Here

// Get Log Files Start Here
    private function getLogFiles()
    {
        $logPath = storage_path('logs');
        $files = [];
        
        try {
            if (is_dir($logPath)) {
                $logFiles = glob($logPath . '/*.log');
                
                if ($logFiles) {
                    foreach ($logFiles as $file) {
                        if (is_file($file)) {
                            $fileName = basename($file);
                            $fileDate = date('Y-m-d', filemtime($file));
                            $fileSize = $this->formatBytes(filesize($file));
                            $lastModified = date('Y-m-d H:i:s', filemtime($file));
                            
                            $files[] = [
                                'name' => $fileName,
                                'date' => $fileDate,
                                'size' => $fileSize,
                                'last_modified' => $lastModified,
                                'path' => $file
                            ];
                        }
                    }
                    
                    // Sort by date descending
                    usort($files, function($a, $b) {
                        return strcmp($b['date'], $a['date']);
                    });
                }
            }
        } catch (\Exception $e) {
            Log::error('Error reading log files: ' . $e->getMessage());
        }
        
        return $files;
    }
// Get Log Files End Here

// Format Bytes Start Here
    private function formatBytes($size, $precision = 2)
    {
        if ($size == 0) return '0 B';
        
        $base = log($size, 1024);
        $suffixes = ['B', 'KB', 'MB', 'GB', 'TB'];
        $index = floor($base);
        
        if ($index >= count($suffixes)) {
            $index = count($suffixes) - 1;
        }
        
        return round(pow(1024, $base - $index), $precision) . ' ' . $suffixes[$index];
    }
// Format Bytes End Here

// View Log Content Start Here
    public function viewLogContent($fileName, Request $request)
    {
        try{
            $logPath = storage_path('logs/' . $fileName);
            
            if (!file_exists($logPath)) {
                return $this->notFoundError('Log file not found!');
            }
            
            $content = file_get_contents($logPath);
            $logs = $this->parseLogContent($content);
            
            // Filter logs if search or level filter is provided
            $search = $request->get('search');
            $level = $request->get('level');
            
            if ($search || $level) {
                $logs = array_filter($logs, function($log) use ($search, $level) {
                    $matchesSearch = !$search || stripos($log['message'], $search) !== false;
                    $matchesLevel = !$level || $log['level'] === $level;
                    return $matchesSearch && $matchesLevel;
                });
            }
            
            // Paginate logs (10 per page)
            $page = $request->get('page', 1);
            $perPage = 10;
            $total = count($logs);
            $logs = array_slice($logs, ($page - 1) * $perPage, $perPage);
            
            $pagination = [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'last_page' => ceil($total / $perPage)
            ];
            
            Log::info("Log Content Successfully Fetched for: {$fileName}");
            return view('admin.extends.setting.view_logs', compact('logs', 'fileName', 'pagination', 'search', 'level'));
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return $this->genericError($e->getMessage(), 'Log Content Fetch Failed!');
        }
    }
// View Log Content End Here

// Parse Log Content Start Here
    private function parseLogContent($content)
    {
        $logs = [];
        $lines = explode("\n", $content);
        
        foreach ($lines as $line) {
            if (preg_match('/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] \w+\.(\w+): (.*)/', $line, $matches)) {
                $logs[] = [
                    'timestamp' => $matches[1],
                    'level' => strtoupper($matches[2]),
                    'message' => $matches[3]
                ];
            }
        }
        
        // Sort by timestamp descending
        usort($logs, function($a, $b) {
            return strcmp($b['timestamp'], $a['timestamp']);
        });
        
        return $logs;
    }
// Parse Log Content End Here

}