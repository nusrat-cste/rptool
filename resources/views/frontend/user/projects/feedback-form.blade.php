<form action="{{ route('frontend.user.dashboard.project.feedback', $project->id) }}" method="POST">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="warning">
                    <th width="30%">Requirements</th>
                    <th>Priority No.</th>
                </tr>
            </thead>

            <tbody>
                @foreach($requirements as $key => $requirement)
                    <tr>
                        <td width="60%">
                            <input type="hidden" name="requirement_id[]" value="{{ $requirement->requirement_id }}">
                            <strong>{{$requirement -> requirement_name}}</strong>
                        </td>
                        <td class="info">
                            {!! Form::select('weight[]', [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], (isset($feedbacks) && $feedbacks[$key]->requirement_id == $requirement->requirement_id) ? $feedbacks[$key]->weight : 3, ['class' => 'form-control match-content']) !!}

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-success center-block">Submit</button>

</form>