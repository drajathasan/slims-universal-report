<?php
/**
 * Plugin Name: SLiMS Universal Report
 * Plugin URI: -
 * Description: Buat laporan sesuai kemauan anda
 * Version: 1.0.0
 * Author: Drajat Hasan
 * Author URI: https://t.me/drajathasan
 */
use SLiMS\Plugins;

Plugins::getInstance()->registerMenu('reporting', 'Universal Report', __DIR__ . '/pages/report.php');