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
     * Retrieve the setting value by its key.
     *
     * @param string $key
     * @return string|null
     */
    public static function getValueByKey(string $key): ?string
    {
        // Try to fetch the value from cache
        return Cache::remember("system_setting_{$key}", now()->addMinutes(60), function () use ($key) {
            $setting = self::where('key', $key)->first();
            return $setting?->value;
        });
    }

    /**
     * Create or update a system setting value.
     *
     * @param string $key
     * @param string $value
     * @return static
     */
    public static function setValueByKey(string $key, string $value): self
    {
        // Use updateOrCreate to manage new or existing settings
        $setting = self::updateOrCreate(['key' => $key], ['value' => $value]);

        // Clear the cached value for the updated setting
        Cache::forget("system_setting_{$key}");

        return $setting;
    }

    /**
     * Get all settings as a key-value pair array.
     *
     * @return array
     */
    public static function getAllSettings(): array
    {
        return Cache::remember('system_settings_all', now()->addMinutes(60), function () {
            return self::all()->pluck('value', 'key')->toArray();
        });
    }

    /**
     * Delete a setting by its key.
     *
     * @param string $key
     * @return bool
     * @throws \Exception
     */
    public static function deleteSettingByKey(string $key): bool
    {
        $setting = self::where('key', $key)->first();

        if (!$setting) {
            throw new \Exception("Setting with key '{$key}' not found.");
        }

        // Delete the setting
        $deleted = $setting->delete();

        // Clear the cache after deletion
        Cache::forget("system_setting_{$key}");

        return $deleted;
    }

    /**
     * Check if a setting exists by its key.
     *
     * @param string $key
     * @return bool
     */
    public static function settingExists(string $key): bool
    {
        return Cache::remember("system_setting_exists_{$key}", now()->addMinutes(60), function () use ($key) {
            return self::where('key', $key)->exists();
        });
    }

    /**
     * Flush the cache for all settings.
     *
     * @return void
     */
    public static function clearSettingsCache(): void
    {
        Cache::forget('system_settings_all');
    }
}
