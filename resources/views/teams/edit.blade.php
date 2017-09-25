@extends('layouts.app')

@section('content')

<div class="secondary-menu">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <a href="/teams">Teams</a> &#187; <a href="/teams/{{ $team->id }}">{{ $team->school_name }}</a> &#187; Edit

            </div><!--  Col  -->

        </div><!--  Row  -->

    </div><!--  Container  -->

</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">

          <div class="content-box">
                
            <form method="POST" action="/teams/{{ $team->id }}">

              {{ method_field('PATCH') }}

              {{ csrf_field() }}

                <h4>Edit {{ $team->school_name }} Information</h4>

                <div class="team-profile">

                  <div class="section-title">
                    School Information
                  </div>

                  <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-6">
                       
                      <div class="form-group">
                        <label for="school_name">School Name</label>
                        <input type="text" class="form-control" id="school_name" name="school_name" value="{{ $team->school_name }}">
                      </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                    
                          <div class="form-group">
                            <label for="mascot">Mascot</label>
                            <input type="text" class="form-control" id="mascot" name="mascot" value="{{ $team->mascot }}">
                          </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                       
                      <div class="form-group">
                        <label for="abbreviated_name">Abbreviated School Name</label>
                        <input type="text" class="form-control" id="abbreviated_name" name="abbreviated_name" value="{{ $team->abbreviated_name }}">
                      </div>

                    </div>

                  </div>

                  <div class="section-title">
                    Location Information
                  </div>

                  <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                        <div class="form-group">
                          <label for="state">State</label>
                            <select name="state" id="state" class="form-control">
                              <option value="" @if ($team->state === '') selected @endif>Select A State</option>
                              <option value="AL" @if ($team->state === 'AL') selected @endif>Alabama</option>
                              <option value="AK" @if ($team->state === 'AK') selected @endif>Alaska</option>
                              <option value="AZ" @if ($team->state === 'AZ') selected @endif>Arizona</option>
                              <option value="AR" @if ($team->state === 'AR') selected @endif>Arkansas</option>
                              <option value="CA" @if ($team->state === 'CA') selected @endif>California</option>
                              <option value="CO" @if ($team->state === 'CO') selected @endif>Colorado</option>
                              <option value="CT" @if ($team->state === 'CT') selected @endif>Connecticut</option>
                              <option value="DE" @if ($team->state === 'DE') selected @endif>Delaware</option>
                              <option value="DC" @if ($team->state === 'DC') selected @endif>District Of Columbia</option>
                              <option value="FL" @if ($team->state === 'FL') selected @endif>Florida</option>
                              <option value="GA" @if ($team->state === 'GA') selected @endif>Georgia</option>
                              <option value="HI" @if ($team->state === 'HI') selected @endif>Hawaii</option>
                              <option value="ID" @if ($team->state === 'ID') selected @endif>Idaho</option>
                              <option value="IL" @if ($team->state === 'IL') selected @endif>Illinois</option>
                              <option value="IN" @if ($team->state === 'IN') selected @endif>Indiana</option>
                              <option value="IA" @if ($team->state === 'IA') selected @endif>Iowa</option>
                              <option value="KS" @if ($team->state === 'KS') selected @endif>Kansas</option>
                              <option value="KY" @if ($team->state === 'KY') selected @endif>Kentucky</option>
                              <option value="LA" @if ($team->state === 'LA') selected @endif>Louisiana</option>
                              <option value="ME" @if ($team->state === 'ME') selected @endif>Maine</option>
                              <option value="MD" @if ($team->state === 'MD') selected @endif>Maryland</option>
                              <option value="MA" @if ($team->state === 'MA') selected @endif>Massachusetts</option>
                              <option value="MI" @if ($team->state === 'MI') selected @endif>Michigan</option>
                              <option value="MN" @if ($team->state === 'MN') selected @endif>Minnesota</option>
                              <option value="MS" @if ($team->state === 'MS') selected @endif>Mississippi</option>
                              <option value="MO" @if ($team->state === 'MO') selected @endif>Missouri</option>
                              <option value="MT" @if ($team->state === 'MT') selected @endif>Montana</option>
                              <option value="NE" @if ($team->state === 'NE') selected @endif>Nebraska</option>
                              <option value="NV" @if ($team->state === 'NV') selected @endif>Nevada</option>
                              <option value="NH" @if ($team->state === 'NH') selected @endif>New Hampshire</option>
                              <option value="NJ" @if ($team->state === 'NJ') selected @endif>New Jersey</option>
                              <option value="NM" @if ($team->state === 'NM') selected @endif>New Mexico</option>
                              <option value="NY" @if ($team->state === 'NY') selected @endif>New York</option>
                              <option value="NC" @if ($team->state === 'NC') selected @endif>North Carolina</option>
                              <option value="ND" @if ($team->state === 'ND') selected @endif>North Dakota</option>
                              <option value="OH" @if ($team->state === 'OH') selected @endif>Ohio</option>
                              <option value="OK" @if ($team->state === 'OK') selected @endif>Oklahoma</option>
                              <option value="OR" @if ($team->state === 'OR') selected @endif>Oregon</option>
                              <option value="PA" @if ($team->state === 'PA') selected @endif>Pennsylvania</option>
                              <option value="RI" @if ($team->state === 'RI') selected @endif>Rhode Island</option>
                              <option value="SC" @if ($team->state === 'SC') selected @endif>South Carolina</option>
                              <option value="SD" @if ($team->state === 'SD') selected @endif>South Dakota</option>
                              <option value="TN" @if ($team->state === 'TN') selected @endif>Tennessee</option>
                              <option value="TX" @if ($team->state === 'TX') selected @endif>Texas</option>
                              <option value="UT" @if ($team->state === 'UT') selected @endif>Utah</option>
                              <option value="VT" @if ($team->state === 'VT') selected @endif>Vermont</option>
                              <option value="VA" @if ($team->state === 'VA') selected @endif>Virginia</option>
                              <option value="WA" @if ($team->state === 'WA') selected @endif>Washington</option>
                              <option value="WV" @if ($team->state === 'WV') selected @endif>West Virginia</option>
                              <option value="WI" @if ($team->state === 'WI') selected @endif>Wisconsin</option>
                              <option value="WY" @if ($team->state === 'WY') selected @endif>Wyoming</option>
                            </select>
                          </div>

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $team->city }}">
                          </div>

                        </div><!--  Col  -->

                    </div><!--  Row  -->

                    <div class="section-title">
                      Baseball Infomation
                    </div>

                    <div class="row">

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="region_baseball">Region</label>
                              <select name="region_baseball" id="region_baseball" class="form-control">
                                <option value="" @if ($team->region_baseball === '') "selected" @endif>Select An Option</option>
                                    @for ($x = 1; $x < 17; $x++)
                                        <option value="{{ $x }}" @if ($team->region_baseball == $x) selected @endif>{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                      </div>

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="district_baseball">District</label>
                              <select name="district_baseball" id="district_baseball" class="form-control">
                                <option value="" @if ($team->district_baseball === '') "selected" @endif>Select An Option</option>
                                    @for ($x = 1; $x < 65; $x++)
                                        <option value="{{ $x }}" @if ($team->district_baseball == $x) selected @endif>{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                      </div>

                    </div>

                    <div class="section-title">
                      Basketball Infomation
                    </div>

                    <div class="row">

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="region_basketball">Region</label>
                              <select name="region_basketball" id="region_basketball" class="form-control">
                                <option value="" @if ($team->region_basketball === '') "selected" @endif>Select An Option</option>
                                    @for ($x = 1; $x < 17; $x++)
                                        <option value="{{ $x }}" @if ($team->region_basketball == $x) selected @endif>{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                      </div><!--  Col  -->

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="district_basketball">District</label>
                              <select name="district_basketball" id="district_basketball" class="form-control">
                                <option value="" @if ($team->district_basketball === '') "selected" @endif>Select An Option</option>
                                    @for ($x = 1; $x < 65; $x++)
                                        <option value="{{ $x }}" @if ($team->district_basketball == $x) selected @endif>{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                      </div><!--  Col  -->

                    </div><!--  Row  -->

                    <div class="section-title">
                      Football Infomation
                    </div>

                    <div class="row">

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="class_football">KHSAA Class</label>
                              <select name="class_football" id="class_football" class="form-control">
                                <option value="" @if ($team->class_football === '') "selected" @endif>Select An Option</option>
                                    @for ($x = 1; $x < 7; $x++)
                                        <option value="{{ $x }}" @if ($team->class_football == $x) selected @endif>{{ $x }}A</option>
                                    @endfor
                              </select>
                          </div>

                      </div><!--  Col  -->

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="district_football">District</label>
                              <select name="district_football" id="district_football" class="form-control">
                                <option value="" @if ($team->district_football === '') "selected" @endif>Select An Option</option>
                                    @for ($x = 1; $x < 65; $x++)
                                        <option value="{{ $x }}" @if ($team->district_football == $x) selected @endif>{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                      </div><!--  Col  -->

                    </div><!--  Row  --> 

                    <div class="section-title">
                      Soccer Infomation
                    </div>

                    <div class="row">

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="region_soccer">Region</label>
                              <select name="region_soccer" id="region_soccer" class="form-control">
                                <option value="" @if ($team->region_soccer === '') "selected" @endif>Select An Option</option>
                                    @for ($x = 1; $x < 17; $x++)
                                        <option value="{{ $x }}" @if ($team->region_soccer == $x) selected @endif>{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                      </div><!--  Col  -->

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="district_soccer">District</label>
                              <select name="district_soccer" id="district_soccer" class="form-control">
                                <option value="" @if ($team->district_soccer === '') "selected" @endif>Select An Option</option>
                                    @for ($x = 1; $x < 65; $x++)
                                        <option value="{{ $x }}" @if ($team->district_soccer == $x) selected @endif>{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div><!--  Col  -->

                      </div><!--  Row  --> 

                      <div class="section-title">
                      Softball Infomation
                    </div>

                    <div class="row">

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="region_softball">Region</label>
                              <select name="region_softball" id="region_softball" class="form-control">
                                <option value="" @if ($team->region_softball === '') "selected" @endif>Select An Option</option>
                                    @for ($x = 1; $x < 17; $x++)
                                        <option value="{{ $x }}" @if ($team->region_softball == $x) selected @endif>{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                      </div><!--  Col  -->

                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="district_softball">District</label>
                              <select name="district_softball" id="district_softball" class="form-control">
                                <option value="" @if ($team->district_softball === '') "selected" @endif>Select An Option</option>
                                    @for ($x = 1; $x < 65; $x++)
                                        <option value="{{ $x }}" @if ($team->district_softball == $x) selected @endif>{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div><!--  Col  -->

                      </div><!--  Row  --> 

                      <div class="section-title">
                        Volleyball Infomation
                      </div>

                      <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="region_volleyball">Region</label>
                              <select name="region_volleyball" id="region_volleyball" class="form-control">
                                <option value="" @if ($team->region_volleyball === '') "selected" @endif>Select An Option</option>
                                    @for ($x = 1; $x < 17; $x++)
                                        <option value="{{ $x }}" @if ($team->region_volleyball == $x) selected @endif>{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">

                          <div class="form-group">
                            <label for="district_volleyball">District</label>
                              <select name="district_volleyball" id="district_volleyball" class="form-control">
                                <option value="" @if ($team->district_volleyball === '') "selected" @endif>Select An Option</option>
                                    @for ($x = 1; $x < 65; $x++)
                                        <option value="{{ $x }}" @if ($team->district_volleyball == $x) selected @endif>{{ $x }}</option>
                                    @endfor
                              </select>
                          </div>

                        </div>

                      </div>

                    </div>

                    <div class="row">

                      <div class="col-lg-12">

                          <div class="form-group">
                              <button type="submit" class="button button-default">Update</button>
                          </div>

                          </form>

                      </div>

                    </div>



            </div>

        </div>

    </div>
</div>
@endsection
