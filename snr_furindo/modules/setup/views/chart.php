<div class="content-header"> 
	<h1>Daftar KasBank</h1>
</div>

<div class="content">
	<div class="box box-primary">
	  	<div class="box-body">
	  		<div id='chartContainer' style="width:100%; height:500px;"></div>
	  		<div style='margin-top: 10px;'>
                <input style='float: left;' id="jpegButton" type="button" value="Save As JPEG" />
                <input style='float: left; margin-left: 5px;' id="pngButton" type="button" value="Save As PNG" />
                <input style='float: left; margin-left: 5px;' id="pdfButton" type="button" value="Save As PDF" />
            </div>
	  	</div>
	</div>
</div>


<script type="text/javascript">
        $(document).ready(function () {
            function getExportServer() {
                return 'http://www.jqwidgets.com/export_server/export.php';
            }
            // prepare data source
            var source =
            {
                datatype: "csv",
                datafields: [
                    { name: 'Country' },
                    { name: 'GDP' },
                    { name: 'DebtPercent' },
                    { name: 'Debt' }
                ],
                url: '<?php echo base_url() ?>assets/gdp_dept_2010.txt'
            };
            var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
            // prepare jqxChart settings
            var settings = {
                title: "Economic comparison",
                description: "GDP and Debt in 2010",
                showLegend: true,
                enableAnimations: true,
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                xAxis:
                {
                    dataField: 'Country'
                },
                colorScheme: 'scheme01',
                seriesGroups:
                    [
                        {
                            type: 'column',
                            columnsGapPercent: 50,
                            valueAxis:
                            {
                                unitInterval: 5000,
                                title: { text: 'GDP & Debt per Capita($)<br>' }
                            },
                            series: [
                                    { dataField: 'GDP', displayText: 'GDP per Capita' },
                                    { dataField: 'Debt', displayText: 'Debt per Capita' }
                                ]
                        },
                        {
                            type: 'line',
                            valueAxis:
                            {
                                unitInterval: 10,
                                title: { text: 'Debt (% of GDP)<br>' },
                                position: 'right',
                                gridLines: { visible: false }
                            },
                            series: [
                                    { dataField: 'DebtPercent', displayText: 'Debt (% of GDP)' }
                                ]
                        }
                    ]
            };
            // setup the chart
            $('#chartContainer').jqxChart(settings);
            $("#jpegButton").jqxButton({});
            $("#pngButton").jqxButton({});
            $("#pdfButton").jqxButton({});
            $("#jpegButton").click(function () {
                // call the export server to create a JPEG image
                $('#chartContainer').jqxChart('saveAsJPEG', 'myChart.jpeg', getExportServer());
            });
            $("#pngButton").click(function () {
                // call the export server to create a PNG image
                $('#chartContainer').jqxChart('saveAsPNG', 'myChart.png', getExportServer());
            });
            $("#pdfButton").click(function () {
                // call the export server to create a PNG image
                $('#chartContainer').jqxChart('saveAsPDF', 'myChart.pdf', getExportServer());
            });
        });
    </script>