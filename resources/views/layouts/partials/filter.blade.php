<div class="gallery-filter-container">
    <div class="row">
        <form method="get" action="{{ route('gallery') }}">
            {{ csrf_field() }}
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <select class="form-control" name="region" id="region">
                        <option value="0" disabled="true" selected="true">{{ Lang::get('lang.region') }}</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->label }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <select class="form-control col-md-3" name="responsible" id="responsible">
                        <option value="0" disabled="true" selected="true">{{ Lang::get('lang.responsible') }}</option>
                        @foreach ($responsibles as $responsible)
                            <option value="{{ $responsible->id }}">{{ $responsible->label }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <button type="submit" class="btn-back">{{ Lang::get('lang.filter') }}</button>
            </div>
        </form>
        <form action="{{ route('top30') }}">
            {{ csrf_field() }}
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <button type="submit" class="btn-back topthirty">{{ Lang::get('lang.top_30') }}</button>
            </div>
        </form>
    </div>
</div>