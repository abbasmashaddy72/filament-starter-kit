<?php

namespace App\Filament\Exports;

use App\Models\QuizUser;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class QuizUserExporter extends Exporter
{
    protected static ?string $model = QuizUser::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('unique_id'),
            ExportColumn::make('name'),
            ExportColumn::make('email'),
            ExportColumn::make('enrollment_type'),
            ExportColumn::make('person_name'),
            ExportColumn::make('person_father_name'),
            ExportColumn::make('person_contact_no'),
            ExportColumn::make('person_dob'),
            ExportColumn::make('dob'),
            ExportColumn::make('location'),
            ExportColumn::make('gender'),
            ExportColumn::make('deleted_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your quiz user export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
