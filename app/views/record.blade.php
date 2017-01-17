@extends('layouts.master')

@section('content')
      <div class="main-wrapper">
        <!-- ACTUAL PAGE CONTENT GOES HERE -->
        <div class="row">
          <div class="col s12 m12 l12">
            <span class="page-title">Patient Records</span>
          </div>

          <div class="row">
      <div class="col s12 m12 l6">
        <div class="col s12 m12 l10">

            <button class="modal-trigger waves-effect waves-light btn btn-small center-text" href="#newprod">ADD NEW PATIENT</button>
            <button class="modal-trigger waves-effect waves-light btn btn-small center-text" href="#viewprod">DELETE ALL PATIENTS</button>
        </div>
      </div>
     </div>

          <div class="nav-wrapper">
    <div class="container">
      <table id="example" class="mdl-data-table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Age</th>
                <th>Last Visit</th>
                <th>Branch</th>
                <th>Actions</th>
            </tr>
        </thead>
        <!-- <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot> -->
        <tbody>
            <tr>
                <td>Amac</td>
                <td>Pamela</td>
                <td></td>
                <td>19</td>
                <td>12/25/16</td>
                <td>Brgy Sangandaan</td>
                <td>
                    <div class="center-btn">
                     <a class="waves-effect waves-light btn btn-small center-text" href="">UPDATE</a>
                     <a class="waves-effect waves-light btn btn-small center-text" href="">DELETE</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>De Guzman</td>
                <td>Naomi</td>
                <td></td>
                <td>19</td>
                <td>01/02/17</td>
                <td>Brgy Sangandaan</td>
                <td>
                    <div class="center-btn">
                     <a class="waves-effect waves-light btn btn-small center-text" href="">UPDATE</a>
                     <a class="waves-effect waves-light btn btn-small center-text" href="">DELETE</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Felix</td>
                <td>Maria Antoinette</td>
                <td>Portillo</td>
                <td>19</td>
                <td>07/29/15</td>
                <td>Brgy Sangandaan</td>
                <td>
                    <div class="center-btn">
                     <a class="waves-effect waves-light btn btn-small center-text" href="">UPDATE</a>
                     <a class="waves-effect waves-light btn btn-small center-text" href="">DELETE</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Gallardo</td>
                <td>Joseph</td>
                <td></td>
                <td>19</td>
                <td>11/01/2016</td>
                <td>Extended Branch 1</td>
                <td>
                    <div class="center-btn">
                     <a class="waves-effect waves-light btn btn-small center-text" href="">UPDATE</a>
                     <a class="waves-effect waves-light btn btn-small center-text" href="">DELETE</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Graspela</td>
                <td>Robb</td>
                <td></td>
                <td>21</td>
                <td>11/05/16</td>
                <td>Brgy Sangandaan</td>
                <td>
                    <div class="center-btn">
                     <a class="waves-effect waves-light btn btn-small center-text" href="">UPDATE</a>
                     <a class="waves-effect waves-light btn btn-small center-text" href="">DELETE</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Lopez</td>
                <td>Joselle</td>
                <td></td>
                <td>20</td>
                <td>08/21/16</td>
                <td>Caloocan Branch</td>
                <td>
                    <div class="center-btn">
                     <a class="waves-effect waves-light btn btn-small center-text" href="">UPDATE</a>
                     <a class="waves-effect waves-light btn btn-small center-text" href="">DELETE</a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    </div>
    <!-- dito naman yung mga susunod na shits kung may idadagdag pa ^_^ -->

  </div>
  


        </div>

@stop

@section('scripts')
 <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.material.min.js"></script>

  <script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ],
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
        "paging":   true,
        "ordering": true,
        "info":     true

    } );
} );
  </script>
@stop

