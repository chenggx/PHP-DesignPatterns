<?php
namespace Creational\SimpleFactory;

class ChartFactory 
{
    //静态工厂方法
    public static function getChart($type)
    {
        if($type === 'histogram'){
            $chart = new HistogramChart();
          }
          if($type === 'pie'){
            $chart = new PieChart();
          }
          if($type === 'line'){
            $chart = new LineChart();
          }

          return $chart;
    }
}
