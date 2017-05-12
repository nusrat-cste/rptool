@extends('backend.layouts.app')

@section('page-header')
   <h1>
        <strong>{{ app_name() }}</strong>
        <small>Reprotizer</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Prioritized requirements of {{ $project->project_name or 'Undefined' }}</h3>
            <div class="box-tools pull-right">
                <a class="btn btn-warning btn-sm" href="{{ url()->previous() }}"><i class="fa fa-angle-double-left"></i> Go back</a>
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div>
                     <div class="box-body">


            <div class="col-md-12">
                <div class="col-md-9 .col-md-push-3">
                      
                <?PHP
                $noS=3; //number of stakeholder
                $noR=4;
              $weights = array( array(5, 5 , 5, 5), //input data in the form, assumed 3 stakeholders and four requirements
               array(5, 4 , 5, 4),
               array(5, 4 , 5, 3) 
             ); 
              $sumArray = [[]];
              $rowSum=[];

                    for ($row = 0; $row < 3; $row++)  //row=number of stakeholder
                    {   
                        $tempSum=0;
                        echo "</br>";
                        for ($col = 0; $col < 4; $col++) //col=number of requirements
                        {
                             $temp=$weights[$row][$col]*3;
                             $div = $temp/4;
                             //$temp=$temp*$temp;
                             $weights[$row][$col] = $div;
                             $square=$weights[$row][$col] *$weights[$row][$col] ;
                             $sumArray[$row][$col]=$square;
                             //echo $sumArray[$row][$col];

                             $tempSum += $square; 

                             echo " ";
                             //echo "tempsum = ".$tempSum;
                        }

                        $rowsum[$row]=$tempSum;
                                for($k = 0; $k< 4 ; $k++){          //k=number of requirements
                                 //echo " ".$sumArray[$row][$k];
                                   $tempVal=$sumArray[$row][$k] / $rowsum[$row];
                                   $sumArray[$row][$k] = $tempVal;
                                   
                                   $number=$sumArray[$row][$k];
                                   $precision = 3;

                                   //echo " ";
                                   //echo substr(number_format($number, $precision+1, '.', ''), 0, -1);
                            }
                }

                for($i=0; $i<4; $i++){          //i=number of requirements
                    $Sum = 0;
                        for($j=0; $j<3; $j++){      //j=number of stakeholders
                             $Sum += $sumArray[$j][$i];
                        }
                    $sumArry[$i] = $Sum;
                     //echo $sumArry[$i]." ";
                    $final[$i]=$sumArry[$i];
                    //echo $final[$i];
                    sort($final);  
                    }
                    echo "prioritized list";
                    for($i = 3; $i>=0; $i--){    //i=numofrequirement-1
                    echo "</br>";
                    echo substr(number_format($final[$i], $precision+1, '.', ''), 0, -1);

                    }
                ?>
                    </div>
                    </br>
                    <!-- /.box-body -->        
                </div>
                <div class="box-body">

                </div>
                <div>


                </div>
                <div class="box-tools">
                    <!-- place for pagination -->
                    <ul class="pagination pagination-sm no-margin pull-right">
                  
                    </ul>
        </div><!-- /.box-body -->
    </div><!--box box-success-->


@endsection