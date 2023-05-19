{{-- ====A+P+P+K+E+Y==== --}}

<a href="#!" class="btn btn-warning text-white action-header
        @if ($showFirst){{'display-n'}}@endif
        " id="image-management-modal"
        data-toggle="modal" data-target="#modalManageImage"
        ><i class="ti-image"></i>
        @lang('default.sidenav.image_management')</a>


        {{-- TO PASS DATA TO ROOT LAYOUT --}}
        <input type="hidden" id="imageModalCondition" value="{{$showFirst}}">

        {{-- PENGATURAN GAMBAR --}}
        <div class="modal  bd-example-modal-lg" id="modalManageImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:70%" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('default.sidenav.image_management')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table" id="tableManageImage">
                            <thead>
                                <th>@lang('default.table.image')</th>
                                <th>@lang('default.table.url')</th>
                            </thead>
                            <tbody>
                                @foreach ($image_management_global as $item)
                                    <tr>
                                        <td>
                                            <a href="{{asset($item->image)}}" data-rel="lightcase">
                                                <img class="table-img-square" src="{{asset($item->image)}}">
                                            </a>
                                        </td>
                                        <td class="imageURL">{{asset('').$item->image}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
