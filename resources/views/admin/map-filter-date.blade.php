<label class="label-flatpickr"> <span id="filterDateRangeLabel">{{ \Carbon\Carbon::parse($week_start)->locale(app()->getLocale())->translatedFormat('d F') }} - {{ \Carbon\Carbon::parse($week_end)->locale(app()->getLocale())->translatedFormat('d F') }}</span>
    <div class="label-flatpickr__container">
        <div class="form-group">
            <input type="date" name="custom_filter_date" id="filterDate" value="{{ \Carbon\Carbon::parse($week_start)->format('Y-m-d') }}" class="flatpickr">
        </div>
    </div>
</label>