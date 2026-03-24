<?php

namespace App\Helpers;

use App\Config\Localization;

/**
 * Language Helper
 * Helper functions for multi-language support
 */
class LanguageHelper
{
    protected static ?string $currentLanguage = null;
    protected static ?Localization $config = null;

    /**
     * Get current language
     */
    public static function getCurrentLanguage(): string
    {
        if (self::$currentLanguage !== null) {
            return self::$currentLanguage;
        }

        $config = self::getConfig();
        $request = service('request');
        $session = session();

        // Check locale from URL path prefix (e.g., /de/, /es/)
        $path = $request->getUri()->getPath();
        $segments = array_values(array_filter(explode('/', trim($path, '/')), 'strlen'));
        if ($segments !== [] && self::isValidLanguage($segments[0]) && $segments[0] !== 'en') {
            self::setLanguage($segments[0], true);
            return self::$currentLanguage;
        }

        // Check URL parameter
        $language = $request->getGet('lang');
        if ($language && self::isValidLanguage($language)) {
            self::setLanguage($language, true);
            return self::$currentLanguage;
        }

        // Check session (explicit user selection)
        if ($session->has($config->sessionKey)) {
            self::$currentLanguage = $session->get($config->sessionKey);
            return self::$currentLanguage;
        }

        // Check cookie (explicit user selection)
        $cookie = $request->getCookie($config->cookieName);
        if ($cookie && self::isValidLanguage($cookie)) {
            self::$currentLanguage = $cookie;
            $session->set($config->sessionKey, $cookie);
            return self::$currentLanguage;
        }

        // Check Accept-Language header
        $acceptLanguage = $request->getHeader('Accept-Language')?->getValue() ?? '';
        $preferredLanguage = self::extractLanguageFromHeader($acceptLanguage);
        if ($preferredLanguage) {
            self::$currentLanguage = $preferredLanguage;
            return self::$currentLanguage;
        }

        // Default language
        self::$currentLanguage = $config->defaultLanguage;
        $session->set($config->sessionKey, self::$currentLanguage);
        return self::$currentLanguage;
    }

    /**
     * Set current language
     */
    public static function setLanguage(string $language, bool $persist = true): bool
    {
        if (!self::isValidLanguage($language)) {
            return false;
        }

        self::$currentLanguage = $language;

        if ($persist) {
            // Store in session
            $config = self::getConfig();
            $session = session();
            $session->set($config->sessionKey, $language);

            // Store in cookie
            $response = service('response');
            $response->setCookie(
                $config->cookieName,
                $language,
                $config->cookieDuration,
                '',
                '/',
                false,
                true
            );
        }

        return true;
    }

    /**
     * Check if language is valid
     */
    public static function isValidLanguage(string $language): bool
    {
        $config = self::getConfig();
        return isset($config->supportedLanguages[$language]);
    }

    /**
     * Get all supported languages
     */
    public static function getSupportedLanguages(): array
    {
        return self::getConfig()->supportedLanguages;
    }

    /**
     * Get language name
     */
    public static function getLanguageName(string $language, bool $native = true): string
    {
        $config = self::getConfig();
        if ($native) {
            return $config->languageNames[$language] ?? $language;
        }
        return $config->supportedLanguages[$language] ?? $language;
    }

    /**
     * Determine if we should auto-redirect to a locale-prefixed URL.
     * Uses Accept-Language only when user has not explicitly selected a language.
     */
    public static function getAutoRedirectUrl(): ?string
    {
        $config = self::getConfig();
        $request = service('request');

        $method = strtolower($request->getMethod());
        if ($method !== 'get' && $method !== 'head') {
            return null;
        }

        // If user explicitly selected a language, do not auto-redirect
        $session = session();
        if ($session->has($config->sessionKey)) {
            return null;
        }

        $cookie = $request->getCookie($config->cookieName);
        if ($cookie && self::isValidLanguage($cookie)) {
            return null;
        }

        $languageParam = $request->getGet('lang');
        if ($languageParam && self::isValidLanguage($languageParam)) {
            return null;
        }

        // If URL already includes a locale segment, skip
        $path = $request->getUri()->getPath();
        $segments = array_values(array_filter(explode('/', trim($path, '/')), 'strlen'));
        if ($segments !== [] && self::isValidLanguage($segments[0])) {
            return null;
        }

        // Use Accept-Language for first visit only
        $acceptLanguage = $request->getHeader('Accept-Language')?->getValue() ?? '';
        $preferredLanguage = self::extractLanguageFromHeader($acceptLanguage);
        if (!$preferredLanguage || $preferredLanguage === 'en') {
            return null;
        }

        return self::getLanguageUrl($preferredLanguage, $path);
    }

    /**
     * Build language-specific URL with locale prefix (non-en only)
     */
    public static function getLanguageUrl(string $language, ?string $path = null): string
    {
        $config = self::getConfig();
        $request = service('request');
        $uri = $request->getUri();

        $path = $path ?? $uri->getPath();
        $path = '/' . ltrim($path, '/');

        $segments = array_values(array_filter(explode('/', trim($path, '/')), 'strlen'));
        $supported = array_keys($config->supportedLanguages);

        if ($segments !== [] && in_array($segments[0], $supported, true) && $segments[0] !== 'en') {
            array_shift($segments);
        }

        $basePath = $segments ? '/' . implode('/', $segments) : '/';

        if ($language === 'en') {
            return $basePath . ($uri->getQuery() !== '' ? '?' . $uri->getQuery() : '');
        }

        return '/' . $language . ($basePath === '/' ? '' : $basePath)
            . ($uri->getQuery() !== '' ? '?' . $uri->getQuery() : '');
    }

    /**
     * Get config instance
     */
    protected static function getConfig(): Localization
    {
        if (self::$config === null) {
            self::$config = config('Localization');
        }
        return self::$config;
    }

    /**
     * Extract language from Accept-Language header
     */
    protected static function extractLanguageFromHeader(string $acceptLanguage): ?string
    {
        if (empty($acceptLanguage)) {
            return null;
        }

        $config = self::getConfig();
        $languages = explode(',', $acceptLanguage);

        foreach ($languages as $lang) {
            $parts = explode(';', $lang);
            $langCode = trim($parts[0]);
            
            // Extract base language code (e.g., 'en' from 'en-US')
            $baseLang = strpos($langCode, '-') !== false 
                ? substr($langCode, 0, 2) 
                : $langCode;

            if (isset($config->supportedLanguages[$baseLang])) {
                return $baseLang;
            }
        }

        return null;
    }
}
