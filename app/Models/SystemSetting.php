<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SystemSetting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'system_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['key', 'value'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'string',
    ];

    /**
     * Get the setting value by key.
     *
     * @param string $key
     * @return string|null
     */
    public static function getValueByKey($key)
    {
        // Try fetching from cache first
        return Cache::remember("system_setting_{$key}", now()->addMinutes(60), function () use ($key) {
            $setting = self::where('key', $key)->first();
            return $setting ? $setting->value : null;
        });
    }

    /**
     * Set or update the value for a given key.
     *
     * @param string $key
     * @param string $value
     * @return bool
     */
    public static function setValueByKey($key, $value)
    {
        // Validate key and value if necessary
        if (empty($key) || !is_string($value)) {
            throw new \InvalidArgumentException("Invalid key or value.");
        }

        // Use updateOrCreate to update existing or create new setting
        $setting = self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        // Clear the cache for this setting after an update
        Cache::forget("system_setting_{$key}");

        return $setting;
    }

    /**
     * Get all system settings as an associative array.
     *
     * @return array
     */
    public static function getAllSettings()
    {
        return Cache::remember('system_settings_all', now()->addMinutes(60), function () {
            return self::all()->pluck('value', 'key')->toArray();
        });
    }

    /**
     * Delete a setting by its key.
     *
     * @param string $key
     * @return bool|null
     */
    public static function deleteSettingByKey($key)
    {
        $setting = self::where('key', $key)->first();

        if (!$setting) {
            throw new \Exception("Setting with key '{$key}' not found.");
        }

        // Delete the setting
        $deleted = $setting->delete();

        // Clear the cache for this setting after deletion
        Cache::forget("system_setting_{$key}");

        return $deleted;
    }

    /**
     * Check if a setting exists by its key.
     *
     * @param string $key
     * @return bool
     */
    public static function settingExists($key)
    {
        return Cache::remember("system_setting_exists_{$key}", now()->addMinutes(60), function () use ($key) {
            return self::where('key', $key)->exists();
        });
    }
}
