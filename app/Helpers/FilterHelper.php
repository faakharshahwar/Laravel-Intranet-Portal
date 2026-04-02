<?php
namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class FilterHelper
{
    public static function filterBySite(Builder $query, $request)
    {
        $site = $request->query('site');

        if (!empty($site) && $site != 'Applicable to All Sites') {
            // Include both 'Applicable to All Sites' and the selected site
            $query->where(function ($q) use ($site) {
                $q->where('site', $site)
                    ->orWhere('site', 'Applicable to All Sites');
            });
        }

        return $query;
    }

    public static function filterByCalibrationCategory(Builder $query, $request)
    {
        $calibrationCategory = $request->query('calibration_category');

        if (!empty($calibrationCategory) && $calibrationCategory != 'All') {
            $query->where('calibration_category', $calibrationCategory);
        }

        return $query;
    }

    public static function filterByDeviceStatus(Builder $query, $request)
    {
        $DeviceStatus = $request->query('device_status');

        if (!empty($DeviceStatus) && $DeviceStatus != 'All') {
            $query->where('device_status', $DeviceStatus);
        }

        return $query;
    }

    public static function filterByDocumentType(Builder $query, $request)
    {
        $documentType = $request->query('document_type');

        if (!empty($documentType) && $documentType != 'All') {
            $query->where('document_type', $documentType);
        }

        return $query;
    }

    public static function filterByLocation(Builder $query, $request)
    {
        $location = $request->query('location');

        if (!empty($location) && $location != 'All') {
            $query->where('location', $location);
        }

        return $query;
    }
}
