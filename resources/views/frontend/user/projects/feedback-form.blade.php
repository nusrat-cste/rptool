<form action="{{ route('frontend.user.dashboard.project.feedback', $project->id) }}" method="POST">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="warning">
                    <th>#</th>
                    <th width="30%">Requirements</th>
                    <th>Business value</th>
                    <th>Effort</th>
                    <th>Alternatives</th>
                    <th>Reusability</th>
                    <th>Priority No.</th>
                </tr>
            </thead>

            <tbody>
                @foreach($requirements as $key => $requirement)
                    <tr>
                        <td>
                            {{ ++$key }}
                        </td>
                        <td width="30%">
                            <input type="hidden" name="requirement_id[]" value="{{ $requirement->requirement_id }}">
                            <strong>{{$requirement -> requirement_name}}</strong>
                        </td>
                        <td>
                            <input class="form-control" type="text" placeholder="Enter value" name="business_value[]" />
                        </td>
                        <td>
                            <input class="form-control" type="text" placeholder="Enter value" name="effort[]" />
                        </td>
                        <td>
                            <input class="form-control" type="text" placeholder="Enter value" name="alternatives[]" />
                        </td>
                        <td>
                            <input class="form-control" type="text" placeholder="Enter value" name="reusability[]" />
                        </td>
                        <td class="info">
                            <select class="form-control match-content" name="weight[]">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3" selected>3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-success center-block">Submit</button>

</form>