    @foreach($permissionGroup as $groupHeading)

    <div class="{{$groupHeading}}">
        <div class="panel panel-default">
            <div class="panel-heading form-group">
                <div class="checkbox {{$groupHeading}}_parent col-md-6 col-xs-6">
                    <label class="grouphead">
                        {{$groupHeading}}
                           <input type="checkbox" onclick="selectAllCheckbox('{{$groupHeading}}',this)">
                    </label>
                </div>
                <div class="col-md-6 col-xs-6 text-right">
                    <i class="fa fa-plus-circle plus-icon" onclick="plusIconHide('{{$groupHeading}}')" data-toggle="collapse" data-target="#{{$groupHeading}}_panel-body"></i>
                    <i class="fa fa-minus-circle minus-icon" onclick="minusIconHide('{{$groupHeading}}')" data-toggle="collapse" data-target="#{{$groupHeading}}_panel-body"></i>
                </div>
                {{--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#{{$groupHeading}}_panel-body">Collapse/Expand</button>--}}
            </div>
            <div id="{{$groupHeading}}_panel-body" class="panel-body form-group collapse in">
                <ul class="col-md-12 col-xs-12">
                @foreach($permissions as $permission)
                    @if($permission['ParentPermission'] === $groupHeading)
                    <li class="clearfix checkbox col-md-3 col-xs-12">
                        <label class="color-blue">
                        <input type="checkbox" name="permissions[]"
                            value="{{$permission['id']}}"
                            @if(in_array($permission['id'], $selectedpermission))
                                checked
                             @endif
                            />
                            {{$permission['AccessLevel']}}
                        </label>
                    </li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach



