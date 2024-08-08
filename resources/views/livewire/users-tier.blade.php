<div>
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-6"></div>
            <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Search Tier:</label>
                                <select wire:change="tierChanged($event.target.value)" wire:model="byTier" class="form-control">
                                    <option value="">All</option>
                                    @foreach ($levels as $lev)
                                    <option value="{{ $lev->level }}">
                                        Tier {{ $lev->level }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Users Tier</h3>
        </div>
        <div class="card-body p-0">
            @if($referralLevels->isEmpty())
            <div class="d-flex justify-content-center">
                No Data Found
            </div>
            @else
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>
                            User Name
                        </th>
                        <th>
                            User Tier
                        </th>
                        <th>
                            Joining Date
                        </th>
                        <th>
                            Commission
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($referralLevels as $referralLevel)
                    <tr>
                        <td>
                            <a>
                                {{ $referralLevel['user']->name }}
                            </a>
                            <br />
                            <small>
                                {{ $referralLevel['user']->user_name }}
                            </small>
                        </td>
                        <td>
                            <span class="badge badge-success"> Tier {{ $referralLevel['level'] }}</span>
                        </td>

                        <td>
                            {{ date('j M Y', strtotime($referralLevel['user']->created_at)) }}

                        </td>
                        <td>
                            <span class="badge badge-warning">{{ get_setting('symbol') }}{{ App\Models\Commissions::where('user_id', Auth::user()->id)->sum('amount') }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class=" d-flex mt-5 justify-content-center">
                {{ $referralLevels->links() }}
            </div>
            @endif
        </div>
    </div>
</div>