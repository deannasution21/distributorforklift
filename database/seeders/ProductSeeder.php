<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Lookup helper: cari sub-kategori berdasarkan slug + parent slug
        $sub = fn (string $systemSlug, string $subSlug) => ProductCategory::whereHas(
            'parent', fn ($q) => $q->where('slug', $systemSlug)
        )->where('slug', $subSlug)->firstOrFail();

        $reachTruck    = $sub('forklift', 'reach-truck');
        $highLift      = $sub('forklift', 'high-lift-stackers');
        $electricTruck = $sub('forklift', 'electric-forklift-trucks');
        $sewaReach     = $sub('sewa-forklift', 'reach-truck');

        $products = [
            // /forklift/reach-truck
            [
                'product_category_id' => $reachTruck->id,
                'name'              => 'Reach Truck 1.4 Ton',
                'slug'              => 'reach-truck-14-ton',
                'short_description' => 'Reach truck listrik kompak untuk lorong sempit, kapasitas 1.4 ton.',
                'full_description'  => '<p style="margin: 0px 0px 1em; max-width: 45em;">The automated FM-X iGo reach truck takes efficiency, performance and flexibility to a new level. From wide-aisle warehouses and flow racking to conveyor technology and VNA transfer stations – the FM-X iGo covers the entire spectrum of automated processes with the utmost precision thanks to its innovative pallet positioning system (PPS). Two other impressive features are its compatibility with a wide range of load carriers and its power.</p><p style="margin: 0px 0px 1em; max-width: 45em;">The FM-X iGo effortlessly lifts up to 2,300 kg on the cantilever forks to storage heights of up to 10 metres. And the lean design allows for a working aisle width of less than 3 metres. For maximum process safety and reliable pedestrian protection, the FM-X iGo is equipped with a multi-level safety system with state-of- the-art laser scanners and sensors that fulfils all the requirements of the ISO 3691-4 safety standard. Its performance is as sophisticated as its handling is straightforward due to the smart STILL iGo automation solution, such as plug-and-play commissioning with iGo easy. By the way: iGo easy permits both stand-alone operation and connection to a WMS. And as your automated fleet grows or you want to automate more processes, the scalable software grows with you. It’s that simple.</p>',
                'image'             => null,
                'image_url'         => 'https://data.still.de/assets/products/Intralogistic_Systems/Automation/images/STILL_DE_Automation-Beratungsgespraech.jpg?w=1200&fit=max&fm=webp&s=24e95524aebbe92a5e5cf3595bd9124a',
                'specs'             => [
                    ['label' => 'Kapasitas Angkat',  'value' => '1.400 kg'],
                    ['label' => 'Tinggi Angkat Maks', 'value' => '9.500 mm'],
                    ['label' => 'Lebar Lorong Min',   'value' => '2.700 mm'],
                ],
                'highlights' => [
                    [
                        'title'       => 'Maximum flexibility and precision in load handling',
                        'description' => 'thanks to cantilever forks and innovative Pallet-Positioning-System',
                        'image_url'   => '/storage/highlight-icons/MaJ4COdE8WFWkKWKukvuk0e5emFnYOfTSbsb8UIa.svg',
                    ],
                    [
                        'title'       => 'High level automation:',
                        'description' => 'the FM-X iGo has a storage height of up to 10 metres',
                        'image_url'   => '/storage/highlight-icons/AkMy6o6DLxViqNY2nLPWC6DtTfZT8k5RMnjXDlOD.svg',
                    ],
                    [
                        'title'       => 'Unbeatable manoeuvrability',
                        'description' => 'with less than 3 m working aisle width',
                        'image_url'   => '/storage/highlight-icons/XAdmzPcJpOyc2ga4Wbk0gVKP7SmNlZ34gVsQsggc.svg',
                    ],
                    [
                        'title'       => 'Simply intuitive:',
                        'description' => 'thanks to the smart iGo easy plug-and-play solution, commissioning and handling are simple and straightforward, as are customisation and scaling',
                        'image_url'   => 'https://data.still.de/assets/products/Vehicles/Automated_industrial_trucks/AXV_iGo/images/Safety.svg?w=320&fit=max&fm=webp&s=7b81b5e337ec2b52c6640bea3194af67',
                    ],
                ],
                'highlight_image' => 'https://data.still.de/assets/products/Vehicles/Electric_Forklift_Trucks/SXV-CB/images/STILL_Fahrzeuge_Elektro-Stapler_SXV-CB_10_Teaser_800x800.png?w=320&fit=max&fm=webp&s=a7bf9f77d6572c84c890d3ca6e80a956',
                'details' => [
                    [
                        'title'      => 'Simply easy',
                        'content'    => '<p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Straightforward integration into existing systems and processes</b><br>with the scalable STILL iGo automation solution</p><p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Can be used flexibly, even in narrow spaces,</b><br>thanks to its compact design and narrow working aisle width of less than 3 metres</p><p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Intuitive control and operation via a user-friendly touchscreen,</b><br>which displays a clear overview of all relevant information</p>',
                        'icon_image' => 'https://data.still.de/assets/products/Vehicles/images/STILL_SEF-Icon_Easy.png?w=222&fit=max&fm=webp&s=dcbf71ee5865e428bd44e26b7ae6e81b',
                        'image'      => '/storage/details/60VgFSz14tn8yrL6Ln3tOl5rjmm0fFAfWg6lqupm.webp',
                    ],
                    [
                        'title'      => 'Simply powerful',
                        'content'    => '<p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Optimum availability and cost efficiency</b><br>thanks to innovative and low- maintenance lithium-ion battery</p><p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Optimised use of space and high storage density</b><br>thanks to a storage height of up to 10 metres</p><p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Safe, precise and flexible storage of a wide variety of goods carriers</b><br>with the smart Pallet-Positioning-System (PPS)</p>',
                        'icon_image' => '/storage/detail-icons/jqxCATqxJk1T7tV7OYJObSurEkx18D3RPbfodhSe.webp',
                        'image'      => '/storage/details/xUXVIv0drbbp68Tajlzqc4BenspsoLQQ6er9Fwad.webp',
                    ],
                    [
                        'title'      => 'Simply safe',
                        'content'    => '<p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Redundant safety system reliably ensures the highest level of safety<br></b>in accordance with ISO standard 3691-4</p><p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Safety and productivity combined with smart features:<br></b>optimal protection for people, trucks and loads thanks to innovative 360° safety laser scanners that create a dynamic safety field around the truck</p><p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Maximum protection:<br></b>safety scanners between the mast and battery compartment reliably detect people in the danger zone and minimise the risk of injury when retracting the mast</p>',
                        'icon_image' => 'https://data.still.de/assets/products/Vehicles/images/STILL_SEF-Icon_Safe.png?w=222&fit=max&fm=webp&s=7a9fb764a538f130cec9b57be8146487',
                        'image'      => '/storage/details/GqtTgiK9jTkTE2JHBtFNacMODk5XPPwggiRR1l7h.webp',
                    ],
                    [
                        'title'      => 'Simply flexible',
                        'content'    => '<p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Flexible route planning:<br></b>different pick-up and drop-off points can be defined</p><p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Versatile<br></b>thanks to compatibility with numerous load carriers</p><p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Always operational thanks to dual operating mode:<br></b>switch to manual operation quickly and easily via the touchscreen if required</p>',
                        'icon_image' => 'https://data.still.de/assets/products/Vehicles/images/STILL_SEF-Icon_Flexible.png?w=222&fit=max&fm=webp&s=1425ba91bb56029aab66e10c6d9b70be',
                        'image'      => 'https://data.still.de/assets/products/Vehicles/Automated_industrial_trucks/FM-X_iGo/images/STILL_Produkt_FM-X-iGo_SEF_04-Simply-Flexible_1440x960.jpg?w=640&fit=max&fm=webp&s=853d877e528e6822b67dfba2de16124c',
                    ],
                    [
                        'title'      => 'Simply connected',
                        'content'    => '<p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Rapid availability and convenient servicing<br></b>thanks to remote access to the truck</p><p style="margin: 0px 0px 1em; max-width: 45em; background-color: rgb(245, 245, 245);"><b>Smart analysis and optimisation of availability and performance<br></b>through connection to the STILL iGo insights analysis tool</p>',
                        'icon_image' => 'https://data.still.de/assets/products/Vehicles/images/STILL_SEF-Icon_Connected.png?w=222&fit=max&fm=webp&s=0a60cdbe87c91e55e96f2770d79a4bbc',
                        'image'      => 'https://data.still.de/assets/products/Vehicles/Automated_industrial_trucks/FM-X_iGo/images/STILL_Produkt_FM-X-iGo_SEF_05-Simply-Connected_1440x960.jpg?w=640&fit=max&fm=webp&s=4dbd575acf776c5df0bb7d8cfacb3f05',
                    ],
                ],
                'solutions_title'       => 'We have the ideal solutions',
                'solutions_description' => 'STILL offers a wide range of different solutions and truck-based extension levels to help you automate your processes. They can be adapted to the complexity of your requirements, meaning that they are guaranteed to pay off every time.',
                'solutions' => [
                    [
                        'label'     => 'Goods-to-person',
                        'video_url' => 'https://youtu.be/eszLj1-q6NQ?si=eBgNVR-ucEYU7h5h',
                        'content'   => '<h3 class="content-tabs-vertical__item-content-headline" style="margin: 0px 0px 1em; line-height: 1.4;">Goods-to-person</h3><p style="margin: 0px 0px 1em;"></p><p style="margin: 0px 0px 1em;">Solution consisting of two different AMRs, racking, picking station and software specifically designed for goods-to-person picking, e.g. in distribution centres, fulfilment warehouses or e-commerce hubs. The solution is characterised by high flexibility, optimal use of space and intelligent control. Bin Pickers store and retrieve bins from the shelves, while Bin Movers transport the bins to the picking stations.</p><p style="margin: 0px 0px 1em;">One Bin Picker and three Bin Movers form a module with the racking and a picking station and are optimally coordinated with each other. Each module has a footprint of 43m² and supplies the picking station with up to 50 bins per hour. For higher performance requirements, modules can be combined and expanded as required.</p><p style="margin: 0px 0px 1em;">Overall, the solution helps to reduce walking distances for staff and organise picking quickly and efficiently. Orders can be completed up to four times faster than with manual picking.</p>',
                    ],
                    [
                        'label'     => 'Production supply',
                        'video_url' => null,
                        'content'   => '<h3 class="content-tabs-vertical__item-content-headline" style="margin: 0px 0px 1em; line-height: 1.4;">Production supply and disposal / empty pallet transport</h3><p style="margin: 0px 0px 1em;"></p><p style="margin: 0px 0px 1em;">Lean production begins with the supply of raw materials for processing. Smooth supply ensures that production does not come to a standstill. These processes are usually also a good starting point for automation.</p><p style="margin: 0px 0px 1em;"><b>Our solution:</b></p><p style="margin: 0px 0px 1em;">Our autonomous mobile robots (AMR) are the smart solution for optimised horizontal material flow. Also for moving pallets when working with a transfer station.The automated all-rounder STILL EXV iGo high lift pallet truck ensures highly efficient logistics processes – as a stand-alone solution or in mixed operation with manual trucks. The truck picks up pallets directly from the floor without any additional hardware.</p><p style="margin: 0px 0px 1em;"><b>Customer reference:</b></p><p style="margin: 0px 0px 1em;">Automated solution in use at the <a href="https://https//www.still.co.uk/solution-competence/references/use-cases/detail/hase-safety-gloves-gmbh-still-takes-warehouse-automation-to-a-new-level.html" title="Hase Safety Group" target="_top" style="">Hase Safety Group</a></p>',
                    ],
                    [
                        'label'     => 'Inbound & outbound',
                        'video_url' => null,
                        'content'   => '<h3 class="content-tabs-vertical__item-content-headline" style="margin: 0px 0px 1em; line-height: 1.4;">Inbound &amp; outbound</h3><p style="margin: 0px 0px 1em;"></p><p style="margin: 0px 0px 1em;">Take your intralogistics to the next level: Store incoming or outgoing pallets within a warehouse, move goods to production or to a material handling system – horizontally and vertically.</p><p style="margin: 0px 0px 1em;"><b>Our solution:<br></b>The automated all-rounder <a href="https://www.still.co.uk/intralogistics-systems/automation-intralogistics/automated-guided-vehicles-agv.html" title="STILL EXV iGo high lift pallet truck" target="_top" style="">STILL EXV iGo high lift pallet truck</a> ensures highly efficient logistics processes – as a stand-alone solution or in mixed operation with manual trucks. The truck picks up pallets directly from the floor without any additional hardware.</p><p style="margin: 0px 0px 1em;"><b>Customer reference:<br></b>Fully automated EXV high lift pallet trucks in action at <a href="https://www.still.co.uk/solution-competence/references/use-cases/detail/more-power-for-danfoss-ai-assisted-automatic-warehouse.html" title="action at Danfoss Power Electronics A/S" target="_top" style="">Danfoss Power Electronics A/S</a></p>',
                    ],
                ],
                'media_items' => [
                    [
                        'type'      => 'image',
                        'title'     => 'Automated reach truck FM-X iGo in use with Safety Light',
                        'image'     => '/storage/media/uL9TTGxyuar4iw5dTy7YTNq7tywEhnP0yCP3lKnS.webp',
                        'video_url' => null,
                    ],
                    [
                        'type'      => 'image',
                        'title'     => null,
                        'image'     => '/storage/media/8cTfqJmsSqpbN5WvBJe1dpqSUOGSuAmS1Yg85JJq.webp',
                        'video_url' => null,
                    ],
                    [
                        'type'      => 'image',
                        'title'     => null,
                        'image'     => 'https://data.still.de/assets/products/Vehicles/Automated_industrial_trucks/FM-X_iGo/images/STILL_Produkt_FM-X-iGo_Mediathek_Einsatz-Licht-an_4K.jpg?w=380&h=300&fit=max&s=33107e0e768a65acfda5dfd1b1c65911',
                        'video_url' => null,
                    ],
                    [
                        'type'      => 'video',
                        'title'     => null,
                        'image'     => null,
                        'video_url' => 'https://youtu.be/eszLj1-q6NQ?si=eBgNVR-ucEYU7h5h',
                    ],
                    [
                        'type'      => 'image',
                        'title'     => null,
                        'image'     => 'https://data.still.de/assets/products/Vehicles/Automated_industrial_trucks/FM-X_iGo/images/STILL_Produkt_FM-X-iGo_Mediathek_Heckansicht_4K.jpg?w=380&h=300&fit=max&s=29f701741ba2cb8c7b4237331382826d',
                        'video_url' => null,
                    ],
                ],
                'model_overview' => [
                    ['label' => 'Maximum capacity (kg)',    'value' => '2330'],
                    ['label' => 'Maximum lift height (mm)', 'value' => '10474'],
                    ['label' => 'Travel speed (km/h)',      'value' => '7,2'],
                ],
                'downloads' => [
                    [
                        'title' => 'Data sheet FM-X iGo',
                        'file'  => '/storage/downloads/VI6u8HoquWxqfR9twfy2IhVBecR4CfoIVZKMj778.pdf',
                        'size'  => '2.4 MB',
                    ],
                ],
                'is_active' => true,
            ],
            [
                'product_category_id' => $reachTruck->id,
                'name'              => 'Reach Truck 2.0 Ton',
                'slug'              => 'reach-truck-20-ton',
                'short_description' => 'Reach truck bertenaga tinggi untuk beban berat dan rak tinggi.',
                'image'             => null,
                'specs'             => [
                    ['label' => 'Kapasitas Angkat',  'value' => '2.000 kg'],
                    ['label' => 'Tinggi Angkat Maks', 'value' => '11.000 mm'],
                    ['label' => 'Lebar Lorong Min',   'value' => '2.900 mm'],
                ],
                'is_active' => true,
            ],
            // /forklift/high-lift-stackers
            [
                'product_category_id' => $highLift->id,
                'name'              => 'High Lift Stacker 1.0 Ton',
                'slug'              => 'high-lift-stacker-10-ton',
                'short_description' => 'Stacker listrik serbaguna untuk penumpukan barang di gudang.',
                'image'             => null,
                'specs'             => [
                    ['label' => 'Kapasitas Angkat',  'value' => '1.000 kg'],
                    ['label' => 'Tinggi Angkat Maks', 'value' => '3.500 mm'],
                    ['label' => 'Kecepatan Jalan',    'value' => '5 km/h'],
                ],
                'is_active' => true,
            ],
            [
                'product_category_id' => $highLift->id,
                'name'              => 'High Lift Stacker 1.5 Ton',
                'slug'              => 'high-lift-stacker-15-ton',
                'short_description' => 'Stacker kapasitas menengah untuk operasi gudang intensitas tinggi.',
                'image'             => null,
                'specs'             => [
                    ['label' => 'Kapasitas Angkat',  'value' => '1.500 kg'],
                    ['label' => 'Tinggi Angkat Maks', 'value' => '4.500 mm'],
                    ['label' => 'Kecepatan Jalan',    'value' => '6 km/h'],
                ],
                'is_active' => true,
            ],
            // /forklift/electric-forklift-trucks
            [
                'product_category_id' => $electricTruck->id,
                'name'              => 'Electric Forklift 2.5 Ton',
                'slug'              => 'electric-forklift-25-ton',
                'short_description' => 'Forklift listrik ramah lingkungan untuk operasi indoor intensitas tinggi.',
                'image'             => null,
                'specs'             => [
                    ['label' => 'Kapasitas Angkat',  'value' => '2.500 kg'],
                    ['label' => 'Tinggi Angkat Maks', 'value' => '4.700 mm'],
                    ['label' => 'Kecepatan Jalan',    'value' => '19 km/h'],
                ],
                'is_active' => true,
            ],
            [
                'product_category_id' => $electricTruck->id,
                'name'              => 'Electric Forklift 3.5 Ton',
                'slug'              => 'electric-forklift-35-ton',
                'short_description' => 'Forklift listrik berkapasitas besar untuk material handling berat.',
                'image'             => null,
                'specs'             => [
                    ['label' => 'Kapasitas Angkat',  'value' => '3.500 kg'],
                    ['label' => 'Tinggi Angkat Maks', 'value' => '5.000 mm'],
                    ['label' => 'Kecepatan Jalan',    'value' => '18 km/h'],
                ],
                'is_active' => true,
            ],
            // /sewa-forklift/reach-truck
            [
                'product_category_id' => $sewaReach->id,
                'name'              => 'Sewa Reach Truck',
                'slug'              => 'sewa-reach-truck',
                'short_description' => 'Solusi sewa fleksibel untuk kebutuhan jangka pendek tanpa komitmen jangka panjang.',
                'image'             => null,
                'specs'             => [
                    ['label' => 'Durasi Minimum',    'value' => '1 hari'],
                    ['label' => 'Kapasitas Tersedia', 'value' => '1.5 – 5 ton'],
                    ['label' => 'Termasuk Operator',  'value' => 'Opsional'],
                ],
                'is_active' => true,
            ],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}
