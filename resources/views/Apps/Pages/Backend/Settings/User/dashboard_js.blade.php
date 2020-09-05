<script>
    var Ajax = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnToaStr('index js successfully load', 'success', {timeOut: 2000});
                var formdata = {};
                //var formdata = {
                //    title: 'ini hanya judul',
                //    description: 'ini deskripsi',
                //    additional_info: 'cuma test aja add info',
                //    integrated_services_post_id: '1',
                //    type_id: '1',
                //    level_id: '1',
                //    country_id: '1',
                //    province_id: '1',
                //    district_id: '1',
                //    sub_district_id: '1',
                //    area_id: '3',
                //};
                //var formdata = {
                //    head_of_family_id: '7',
                //    spouse_id: '8',
                //    address: 'awdawdawd',
                //    country_id: '1',
                //    province_id: '1',
                //    district_id: '1',
                //    sub_district_id: '1',
                //    area_id: '2',
                //};
                //var formdata = {
                //    family_id: '7',
                //    type_id: '8',
                //    length: '9m',
                //    width: '4m',
                //    year_build: '2007',
                //    electricity_capacities_id: '2',
                //    address: 'dasdasdasd',
                //    lat: '132213123123123',
                //    lng: '12312312',
                //    zoom: '4',
                //    total_floor: '2',
                //    quality_rank_id: '4',
                //    description: 'ya cuma test',
                //    country_id: '1',
                //    province_id: '1',
                //    district_id: '1',
                //    sub_district_id: '1',
                //    area_id: '5',
                //};
                //var formdata = {
                //    code: '003',
                //    name: 'Anak Bangsa',
                //    liable_by: 'Masakini rambo',
                //    address: 'dasdasdasd',
                //    lat: '132213123123123',
                //    lng: '12312312',
                //    zoom: '4',
                //    country_id: '1',
                //    province_id: '1',
                //    district_id: '1',
                //    sub_district_id: '1',
                //    area_id: '6',
                //};
                //var formdata = {
                //    'area_id': Base64.encode(3)
                //};
                //var formdata = {
                //    'module_id': 3,
                //    'logged': 1,
                //    'module_name': 'Mobile'
                //};
                //'id':Base64.encode(1)
                var uri = 'https://private-4639ce-ecommerce56.apiary-mock.com/home';
                var res = fnAjaxSend(formdata,uri, 'GET', null, false);
                console.log(res.responseJSON[0].data);
            }
        };

    }();

    jQuery(document).ready(function () {
        Ajax.init();
    });

</script>