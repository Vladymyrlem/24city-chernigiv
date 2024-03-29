<?php

namespace DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils;

use DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossSellingHandler;
use DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossRealMediaLibrary;
use DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossRealCategoryLibrary;
use DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossRealCookieBanner;
use DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossRealPhysicalMedia;
use DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\view\Options;
use DevOwl\RealCustomPostOrder\Vendor\MatthiasWeb\Utils\Service as UtilsService;
use DevOwl\RealCustomPostOrder\Vendor\MatthiasWeb\Utils\ServiceNoStore;
// @codeCoverageIgnoreStart
\defined('ABSPATH') or die('No script kiddies please!');
// Avoid direct file request
// @codeCoverageIgnoreEnd
/**
 * Core for real-utils. It is only initialized once and holds all available initiators.
 */
class Core {
    use UtilsProvider;
    /**
     * The initiators need to be declared globally, due to the fact the class instance
     * itself is scoped and can exist more than once.
     */
    const GLOBAL_INITIATORS = 'real_utils_initiators';
    /**
     * Singleton instance.
     */
    private static $me;
    /**
     * Assets handler.
     *
     * @var Assets
     */
    private $assets;
    /**
     * Rating handler.
     *
     * @var RatingHandler
     */
    private $ratingHandler;
    /**
     * Cross-selling handler.
     *
     * @var CrossSellingHandler
     */
    private $crossSellingHandler;
    /**
     * Cross selling implementations (key valued array).
     *
     * @var array<string,AbstractCrossSelling>
     */
    private $crossSelling = [];
    /**
     * C'tor.
     */
    private function __construct() {
        \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\UtilsProvider::setupConstants();
        $this->ratingHandler = \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\RatingHandler::instance($this);
        $this->crossSellingHandler = \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossSellingHandler::instance(
            $this
        );
        $this->assets = \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\Assets::instance();
        $options = \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\view\Options::instance();
        add_action('rest_api_init', [
            \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\Service::instance(),
            'rest_api_init'
        ]);
        add_action('admin_enqueue_scripts', [$this->getAssets(), 'admin_enqueue_scripts']);
        // We have decided to (temporarily) deactivate cross selling, see also https://app.clickup.com/t/ajyaar
        // add_action('admin_init', [$options, 'admin_init']);
        // Enable `no-store` for our relevant WP REST API endpoints
        \DevOwl\RealCustomPostOrder\Vendor\MatthiasWeb\Utils\ServiceNoStore::hook(
            '/' . \DevOwl\RealCustomPostOrder\Vendor\MatthiasWeb\Utils\Service::getNamespace($this)
        );
        // Initialize our cross-selling products
        $this->crossSelling[
            \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossRealCookieBanner::SLUG
        ] = new \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossRealCookieBanner();
        $this->crossSelling[
            \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossRealMediaLibrary::SLUG
        ] = new \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossRealMediaLibrary();
        $this->crossSelling[
            \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossRealCategoryLibrary::SLUG
        ] = new \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossRealCategoryLibrary();
        $this->crossSelling[
            \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossRealPhysicalMedia::SLUG
        ] = new \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\cross\CrossRealPhysicalMedia();
        \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\Localization::instanceThis()->hooks();
    }
    /**
     * Add an initiator.
     *
     * @param AbstractInitiator $initiator
     * @codeCoverageIgnore
     */
    public function addInitiator($initiator) {
        $slug = $initiator->getPluginSlug();
        $this->getInitiators();
        // Initialize global once
        $GLOBALS[self::GLOBAL_INITIATORS][$slug] = $initiator;
    }
    /**
     * Return the base URL to assets. Please ensure a trailing slash, if you override it!
     *
     * @param string $path
     * @codeCoverageIgnore
     */
    public function getBaseAssetsUrl($path = '') {
        return 'https://assets.devowl.io/in-app/' . $path;
    }
    /**
     * Get initiator by slug.
     *
     * @param string $slug
     * @codeCoverageIgnore
     */
    public function getInitiator($slug) {
        $initiators = $this->getInitiators();
        return isset($initiators[$slug]) ? $initiators[$slug] : null;
    }
    /**
     * Get all initiators.
     *
     * @codeCoverageIgnore
     * @return AbstractInitiator[]
     */
    public function getInitiators() {
        if (!isset($GLOBALS[self::GLOBAL_INITIATORS])) {
            $GLOBALS[self::GLOBAL_INITIATORS] = [];
        }
        return $GLOBALS[self::GLOBAL_INITIATORS];
    }
    /**
     * Get assets handler.
     *
     * @codeCoverageIgnore
     */
    public function getAssets() {
        return $this->assets;
    }
    /**
     * Get rating handler.
     *
     * @codeCoverageIgnore
     */
    public function getRatingHandler() {
        return $this->ratingHandler;
    }
    /**
     * Get cross-selling handler.
     *
     * @codeCoverageIgnore
     */
    public function getCrossSellingHandler() {
        return $this->crossSellingHandler;
    }
    /**
     * Get rating handler.
     *
     * @param string $slug
     * @codeCoverageIgnore
     */
    public function getCrossSelling($slug) {
        return isset($this->crossSelling[$slug]) ? $this->crossSelling[$slug] : null;
    }
    /**
     * Get rating handler.
     *
     * @codeCoverageIgnore
     */
    public function getCrossSellings() {
        return $this->crossSelling;
    }
    /**
     * Get singleton core class.
     *
     * @codeCoverageIgnore
     * @return Core
     */
    public static function getInstance() {
        return !isset(self::$me)
            ? (self::$me = new \DevOwl\RealCustomPostOrder\Vendor\DevOwl\RealUtils\Core())
            : self::$me;
    }
}
