<div class="modal modal--aside fade" id="interventionProjectLocationModal" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-extra-large modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body pt-0 mb-5">  
                <div class="row mt-3">
                    <div class="col-md-7">
                        <div class="d-flex justify-content-between mb-3">
                            <h2 class="text-center">Point de départ</h2> 
                            <h1 class="text-center">{{ $project->Nom }} </h1> 
                        </div>
                        <table class="table table-borderless mt-4">
                                <tr style="border-bottom: 2px solid">
                                    <th>#</th>
                                    <th>Client </th>
                                    <th>Projet </th>
                                    <th>Distance</th>
                                </tr>
                            @foreach ($projects as $project_item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('files.index', $project_item['id']) }}">{{ $project_item['Nom'] }}</a></td>
                                    <td>{{ $project_item['tag'] }} </td>
                                    <td>{!! $project_item['distance'] !!} </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-md-5 text-right">
                        <a href="javascript:void(0)" class="btn mb-3 shadow-none" style="background-color: #DAE3F3; border:3px solid #2F528F">Magic Planning</a>
                        <div class="map position-relative h-100">
                            <div class="map-wrapper position-relative h-100">
                                <div id="custom-map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>