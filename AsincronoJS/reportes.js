alertify.set('notifier', 'position', 'top-right');
var morris1= new Morris.Line({
    // ID of the element in which to draw the chart.
    element: 'morris',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [
        { year: '2014', value: 35,  value2:10 },
        { year: '2015', value: 13,  value2:20 },
        { year: '2016', value: 10,  value2:30},
        { year: '2017', value: 8,   value2:40 },
        { year: '2018', value: 7,   value2:50 }
    ],
    // The name of the data record attribute that contains x-values.
    xkey: 'year',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['value','value2'],
    lineWidth:1,
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['coca-cola','pepsi'],
    resize:true,
    lineColors:['#325bc1','#acb41a']
});
function listar() {
    $.get('/adm/Reportes/listar').done(function (data) {
        console.log(data);
         
        // data=JSON.parse(data);
        // console.log(data);
        // morris1.setData(data);
    }).fail(function () {
        alertify.error("ERROR SERVER");
    })
}
