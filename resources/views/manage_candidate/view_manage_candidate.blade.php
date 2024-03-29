@extends('layouts.default')

@section('contents')
    <div class="manage-candidate">
        <h2>List of Candidate</h2>
        <table id="table">
            <thead>
                <tr>
                    <th id="name">Candidate Name</th>
                    <th id="action">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $candidate)
                    <tr>
                        <td id="name">{{ $candidate->full_name }}</td>
                        <td id="action" style="text-align: center">
                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                data-bs-target="#modal-edit-{{ $candidate->id }}">Edit</button>
                            &nbsp;&nbsp;
                            <a href="manage-candidate/{{ $candidate->id }}/delete"
                                onclick="return confirm('Are You Sure?')">
                                <button class="btn btn-danger" type="button">Delete</button>
                            </a>
                        </td>
                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="modal-edit-{{ $candidate->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="/admin/manage-candidate/{{ $candidate->id }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Candidate</h1>
                                    </div>
                                    <div class="modal-body">
                                        <center>
                                            <div class="container">
                                                <div class="picture-container">
                                                    <div class="picture">
                                                        <img src="{{ $candidate->decoded_image }}" class="picture-src"
                                                            id="wizardPicturePreview-{{ $candidate->id }}" title="">
                                                        <input type="file" id="wizard-picture-{{ $candidate->id }}" class=""
                                                            name="image" value="{{ $candidate->image }}">
                                                    </div>
                                                    <h6 class="">Choose Picture</h6>
                                                </div>
                                            </div>
                                        </center>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
                                                document.getElementById('wizard-picture-{{ $candidate->id }}').addEventListener('change', function () {
                                                    readURL(this, '{{ $candidate->id }}');
                                                });

                                                function readURL(input, candidateId) {
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function (e) {
                                                            document.getElementById('wizardPicturePreview-' + candidateId).src = e.target.result;
                                                        };

                                                        reader.readAsDataURL(input.files[0]);
                                                    }
                                                }
                                            });
                                        </script>
                                        <br>
                                        <div class="container text-center">
                                            <div class="row">
                                                <div class="col-sm-5 col-md-6">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Candidate
                                                            Name</span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Ex: Nafiz Mansor" aria-label="full_name"
                                                            aria-describedby="basic-addon1" name="full_name"
                                                            value="{{ $candidate->full_name }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Matric
                                                            ID</span>
                                                        <input type="text" class="form-control" placeholder="Ex: CA29990"
                                                            aria-label="matric_id" aria-describedby="basic-addon1"
                                                            name="matric_id" value="{{ $candidate->matric_id }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-5 col-lg-6">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Course</span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Ex: Bachelor of Science Computer"
                                                            aria-label="course" aria-describedby="basic-addon1"
                                                            name="course" value="{{ $candidate->course }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Year</span>
                                                        <input type="number" class="form-control" placeholder="Ex: 2000"
                                                            aria-label="year" aria-describedby="basic-addon1" name="year"
                                                            value="{{ $candidate->year }}" required>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-5 col-lg-6">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Semester</span>
                                                        <input type="number" min="0" max="2"
                                                            class="form-control" placeholder="Ex: 2" aria-label="semester"
                                                            aria-describedby="basic-addon1" name="semester"
                                                            value="{{ $candidate->semester }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Manifesto</span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Ex: Type the manifesto" aria-label="manifesto"
                                                            aria-describedby="basic-addon1" name="manifesto"
                                                            value="{{ $candidate->manifesto }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-5 col-lg-6">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Position</span>
                                                        {{-- <input type="text" class="form-control"
                                                            placeholder="Ex: Type the position" aria-label="position"
                                                            aria-describedby="basic-addon1" name="position"
                                                            value="{{ $candidate->position }}" required> --}}
                                                        <select name="position" class="form-control" required>
                                                            <option value="{{ $candidate->position }}" hidden>
                                                                {{ $candidate->position }}</option>
                                                            <option value="Student Affair">Student Affair</option>
                                                            <option value="Welfare Exco">Welfare Exco</option>
                                                            <option value="Sports Exco">Sports Exco</option>
                                                            <option value="Secretary">Secretary</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Link to
                                                            video</span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Ex: youtube.com" aria-label="video_link"
                                                            aria-describedby="basic-addon1" name="video_link"
                                                            value="{{ $candidate->video_link }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @php
                                                    foreach ($criterias as $criteria) {
                                                        $hasVote = false; // Initialize to false for each criteria
                                                        foreach ($voterRate as $rate) {
                                                            if ($rate->criteria_id == $criteria->id && $rate->candidate_name == $candidate->full_name) {
                                                                $hasVote = true; // Set to true if there is a vote for the current criteria
                                                                break; // No need to continue checking once a vote is found
                                                            }
                                                        }
                                                @endphp

                                                @if ($hasVote)
                                                    <div class="col-sm-5 col-md-6">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">{{ $criteria->name }}</span>
                                                            <input type="number" min="0" max="5"
                                                                   class="form-control" placeholder="Ex: 3.5 rating"
                                                                   aria-label="volunteering_point"
                                                                   aria-describedby="basic-addon1" name="rate"
                                                                   value="{{ $rate->rate }}" required>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-sm-5 col-md-6">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">{{ $criteria->name }}</span>
                                                            <input type="number" min="0" max="5"
                                                                   class="form-control" placeholder="Ex: 3.5 rating"
                                                                   aria-label="volunteering_point"
                                                                   aria-describedby="basic-addon1" name="rate"
                                                                   value="0" required>
                                                        </div>
                                                    </div>
                                                @endif

                                                @php
                                                    }
                                                @endphp
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>

        </table>
    </div>


    <center style="padding-right: 150px">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-add-candidate">
            Add
        </button>
    </center>

    <!-- Modal Add -->
    <div class="modal fade" id="modal-add-candidate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="/admin/manage-candidate" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Candidate</h1>
                    </div>
                    <div class="modal-body">
                        <center>
                            <div class="container">
                                <div class="picture-container">
                                    <div class="picture">
                                        <img src="https://lh3.googleusercontent.com/LfmMVU71g-HKXTCP_QWlDOemmWg4Dn1rJjxeEsZKMNaQprgunDTtEuzmcwUBgupKQVTuP0vczT9bH32ywaF7h68mF-osUSBAeM6MxyhvJhG6HKZMTYjgEv3WkWCfLB7czfODidNQPdja99HMb4qhCY1uFS8X0OQOVGeuhdHy8ln7eyr-6MnkCcy64wl6S_S6ep9j7aJIIopZ9wxk7Iqm-gFjmBtg6KJVkBD0IA6BnS-XlIVpbqL5LYi62elCrbDgiaD6Oe8uluucbYeL1i9kgr4c1b_NBSNe6zFwj7vrju4Zdbax-GPHmiuirf2h86eKdRl7A5h8PXGrCDNIYMID-J7_KuHKqaM-I7W5yI00QDpG9x5q5xOQMgCy1bbu3St1paqt9KHrvNS_SCx-QJgBTOIWW6T0DHVlvV_9YF5UZpN7aV5a79xvN1Gdrc7spvSs82v6gta8AJHCgzNSWQw5QUR8EN_-cTPF6S-vifLa2KtRdRAV7q-CQvhMrbBCaEYY73bQcPZFd9XE7HIbHXwXYA=s200-no"
                                            class="picture-src" id="wizardPicturePreview" title="">
                                        <input type="file" id="wizard-picture" class="" name="image">
                                    </div>
                                    <h6 class="">Choose Picture</h6>
                                </div>
                            </div>
                        </center>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                document.getElementById('wizard-picture').addEventListener('change', function () {
                                    readURL(this);
                                });

                                function readURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            document.getElementById('wizardPicturePreview').src = e.target.result;
                                        };

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }
                            });
                        </script>
                        <br>
                        <div class="container text-center">
                            <div class="row">
                                <div class="col-sm-5 col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Candidate Name</span>
                                        <input type="text" class="form-control" placeholder="Ex: Nafiz Mansor"
                                            aria-label="full_name" aria-describedby="basic-addon1" name="full_name"
                                            required>
                                    </div>
                                </div>
                                <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Matric ID</span>
                                        <input type="text" class="form-control" placeholder="Ex: CA29990"
                                            aria-label="matric_id" aria-describedby="basic-addon1" name="matric_id"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-5 col-lg-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Course</span>
                                        <input type="text" class="form-control"
                                            placeholder="Ex: Bachelor of Science Computer" aria-label="course"
                                            aria-describedby="basic-addon1" name="course" required>
                                    </div>
                                </div>
                                <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Year</span>
                                        <input type="number" class="form-control" placeholder="Ex: 2000"
                                            aria-label="year" aria-describedby="basic-addon1" name="year" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-5 col-lg-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Semester</span>
                                        <input type="number" min="0" max="2" class="form-control"
                                            placeholder="Ex: 2" aria-label="semester" aria-describedby="basic-addon1"
                                            name="semester" required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Manifesto</span>
                                        <input type="text" class="form-control" placeholder="Ex: Type the manifesto"
                                            aria-label="manifesto" aria-describedby="basic-addon1" name="manifesto"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-5 col-lg-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Position</span>
                                        {{-- <input type="text" class="form-control" placeholder="Ex: Type the position"
                                            aria-label="position" aria-describedby="basic-addon1" name="position"
                                            required> --}}
                                        <select name="position" class="form-control" required>
                                            <option hidden>
                                                Choose the position</option>
                                            <option value="Student Affair">Student Affair</option>
                                            <option value="Welfare Exco">Welfare Exco</option>
                                            <option value="Sports Exco">Sports Exco</option>
                                            <option value="Secretary">Secretary</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Link to video</span>
                                        <input type="text" class="form-control" placeholder="Ex: youtube.com"
                                            aria-label="video_link" aria-describedby="basic-addon1" name="video_link"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($criterias as $criteria)
                                    <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">{{ $criteria->name }}</span>
                                            <input type="number" min="0" max="5" class="form-control"
                                                placeholder="Ex: 3.5 rating" aria-label="rate"
                                                aria-describedby="basic-addon1" name="rate" value="" required>
                                        </div>
                                    </div>
                                    <input type="text" hidden value="{{ $criteria->id }}" name="criteriaId">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if (DB::table('manage_criterias')->count() == 0)
                            <div>
                                You doesn't have the Criteria. Create one first.
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        @else
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Save</button>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
