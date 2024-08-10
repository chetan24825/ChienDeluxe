<div class="col-sm-2">
    <div class="card border-secondary" style="margin-top: 27px">
        <div class="card-body">
            <h3 class="h5 card-title">Colors</h3>
            <div class="row">
                @foreach ($colors as $key => $data)
                    <div class="col-12">
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" value=""
                                id="cartCheck{{ $key }}">
                            <label class="colour-colorDisplay" for="cartCheck{{ $key }}"
                                style="background-color: {{ $data->code }};">
                            </label>
                            <span class="fs">{{ $data->name }}</span>
                        </div>
                    </div>
                @endforeach

                @if ($colors->hasMorePages())
                    <div class="text-center mt-3">
                        <button wire:click="loadMore" class="badge badge-dark">Load
                            More</button>
                    </div>
                @endif


            </div>
        </div>
    </div>

    <div class="card border-secondary mt-2">
        <div class="card-body">
            <h5 class="card-title">Price Range</h5>
            <!-- Simple slider -->
            <div class="form-group">
                <input type="range" class="form-control-range" id="formControlRange">
            </div>
            <!-- End of Slider -->
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Min</label>
                    <input class="form-control mt-2" placeholder="$0" type="number">
                </div>
                <div class="form-group text-right col-md-12">
                    <label>Max</label>
                    <input class="form-control mt-2" placeholder="$1,0000" type="number">
                </div>
            </div>
            <button class="btn btn-block btn-primary mt-2">Apply</button>
        </div>
    </div>

</div>
