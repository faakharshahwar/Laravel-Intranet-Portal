<select id="site" name="site" data-control="select2"
        data-placeholder="Filter By Site..."
        class="form-select form-select-solid me-3">
    <option value="" disabled selected></option>
    @foreach($siteArr as $site)
        <option value="{{ $site }}" {{ $selectedSite == $site ? 'selected' : '' }}>
            {{ $site }}
        </option>
    @endforeach
</select>
