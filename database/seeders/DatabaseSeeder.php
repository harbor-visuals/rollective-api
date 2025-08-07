<?php

/**
 * This file contains the seeder for the entire rollective project.
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Frame;
use App\Models\Comment;
use App\Models\Roll;

use Illuminate\Support\Facades\Log;
// faker: https://fakerphp.github.io/formatters/text-and-paragraphs/

class DatabaseSeeder extends Seeder
{
  // Method that runs the seeder to populate the table with initial records
  function run()
  {
    // Empty the media folder
    File::deleteDirectory(public_path('media/images'), true);

    // Array with the users data that will be seeded
    $users = [
      [
        "email" => "marcus.bennett@gmail.com",
        "username" => "marcusbennett",
        "name" => "Marcus Bennett",
        "biography" => "Always chasing light and shadow.",
        "location" => "Chicago",
        "photo" => "user-1.webp",
      ],
      [
        "email" => "liam.carter@gmail.com",
        "username" => "liamcarter92",
        "name" => "Liam Carter",
        "biography" => "Curious about everything, especially old cameras.",
        "location" => "Portland",
        "photo" => "user-2.webp",
      ],
      [
        "email" => "noah.jensen@gmail.com",
        "username" => "noah_jensen",
        "name" => "Noah Jensen",
        "biography" => "Nature and film—my two favorite things.",
        "location" => "Oslo",
        "photo" => "user-3.webp",
      ],
      [
        "email" => "henry.miller@gmail.com",
        "username" => "henrymiller89",
        "name" => "Henry Miller",
        "biography" => "Photographer, wanderer, latte addict.",
        "location" => "Berlin",
        "photo" => "user-4.webp",
      ],
      [
        "email" => "isabel.cruz@gmail.com",
        "username" => "isabelcruzx",
        "name" => "Isabel Cruz",
        "biography" => "Capturing the in-between moments.",
        "location" => "Lisbon",
        "photo" => "user-5.webp",
      ],
      [
        "email" => "malik.washington@gmail.com",
        "username" => "malikwash88",
        "name" => "Malik Washington",
        "biography" => "Dreamer with a lens and a purpose.",
        "location" => "Atlanta",
        "photo" => "user-6.webp",
      ],
      [
        "email" => "nina.fischer@gmail.com",
        "username" => "ninafischer",
        "name" => "Nina Fischer",
        "biography" => "Forest walks and analog grain.",
        "location" => "Munich",
        "photo" => "user-7.webp",
      ],
      [
        "email" => "darnell.young@gmail.com",
        "username" => "darnellyoung",
        "name" => "Darnell Young",
        "biography" => "Documenting life, one frame at a time.",
        "location" => "Detroit",
        "photo" => "user-8.webp",
      ],
      [
        "email" => "jakob.nilsson@gmail.com",
        "username" => "jakobnilsson",
        "name" => "Jakob Nilsson",
        "biography" => "Warm tones, cold climates.",
        "location" => "Stockholm",
        "photo" => "user-9.webp",
      ],
      [
        "email" => "takeshi.sato@gmail.com",
        "username" => "takeshisato",
        "name" => "Takeshi Sato",
        "biography" => "Minimal light, maximum feeling.",
        "location" => "Kyoto",
        "photo" => "user-10.webp",
      ],
    ];


    // Loop through the users data
    foreach ($users as $user) {
      // generate a unique filename (before the creation to have matching filename and db entry)
      $filename = Str::uuid() . ".png";

      // creation of the user
      $createUser = User::create([
        'email' => $user['email'],
        'username' => $user['username'],
        'password' => 'password', // Is hashed by a method in the model (booted)
        'name' => $user['name'],
        'picture' => $filename,
        'biography' => $user['biography'],
        'location' => $user['location'],
      ]);

      // path of the placeholder image
      $sourcePath = database_path('seeders/placeholder/user/' . $user['photo']);

      // path of where the image should be stored
      $destinationPath = 'media/images/' . $createUser->id;

      // save the placeholder file in the media user folder
      Storage::putFileAs($destinationPath, $sourcePath, $filename);
    }

    // Array with the rolls data that will be seeded
    $rolls = [
      ['name' => 'Portrait', 'emoji' => '🧑🏻'],
      ['name' => 'Street', 'emoji' => '🚶🏻‍♀️'],
      ['name' => 'Landscape', 'emoji' => '🌄'],
      ['name' => 'Product', 'emoji' => '📦'],
      ['name' => 'Nature', 'emoji' => '🌿'],
      ['name' => 'Wildlife', 'emoji' => '🦌'],
      ['name' => 'Architecture', 'emoji' => '🏛️'],
      ['name' => 'Travel', 'emoji' => '✈️'],
      ['name' => 'Documentary', 'emoji' => '🎥'],
      ['name' => 'Sport', 'emoji' => '🏅'],
      ['name' => 'Food', 'emoji' => '🍽️'],
      ['name' => 'Night', 'emoji' => '🌌'],
      ['name' => 'Low Light', 'emoji' => '🔦'],
      ['name' => 'Macro', 'emoji' => '🔍'],
      ['name' => 'Abstract', 'emoji' => '🎨'],
      ['name' => 'Minimalism', 'emoji' => '🔲'],
      ['name' => 'Underwater', 'emoji' => '🌊'],
      ['name' => 'Wedding', 'emoji' => '💍'],
      ['name' => 'Fashion', 'emoji' => '👗'],
      ['name' => 'Action', 'emoji' => '🏃‍♂️'],
      ['name' => 'Event & Concert', 'emoji' => '🎤'],
      ['name' => 'Black & White', 'emoji' => '⚫⚪'],
      ['name' => 'Aerial', 'emoji' => '🚁'],
      ['name' => 'Commercial', 'emoji' => '💼'],
      ['name' => 'Self-Portrait', 'emoji' => '🤳🏻'],
      ['name' => 'Conceptual', 'emoji' => '💡'],
      ['name' => 'Expired', 'emoji' => '⏳'],
      ['name' => 'Moody', 'emoji' => '🌫️'],
      ['name' => 'Automotive', 'emoji' => '🚗'],
      ['name' => 'Long Exposure', 'emoji' => '🌀'],
    ];

    // Loop through the rolls data
    foreach ($rolls as $roll) {
      // creation of the roll
      Roll::create([
        'name' => $roll['name'],
        'emoji' => $roll['emoji'],
      ]);
    }

    // Array with the frames data (including the comments) that will be seeded
    $framesSeedData = [
      [
        'file' => 'frame-1.webp',
        'caption' => 'Sea lions basking under the sun on a rocky coast.',
        'location' => 'La Jolla Cove',
        'camera' => 'Canon AE-1 Program',
        'lens' => 'Canon FD 50mm f/1.8',
        'film' => 'Kodak Gold 200',
        'lab' => 'The Darkroom Lab',
        'roll_ids' => [6, 5, 8],
        'comments' => [
          'Amazing to see them so close to the shore!',
          'That lighting is perfect—feels so peaceful.',
          'La Jolla never disappoints. Great shot!',
        ],
      ],
      [
        'file' => 'frame-2.webp',
        'caption' => 'Golden hour reflecting off the crashing waves.',
        'location' => 'Pacific Beach',
        'camera' => 'Olympus OM-1',
        'lens' => 'Zuiko 50mm f/1.4',
        'film' => 'Fujifilm Superia X-TRA 400',
        'lab' => 'Indie Film Lab',
        'roll_ids' => [3, 5, 8],
        'comments' => [
          'The shimmer on the water is unreal!',
          'This could be a postcard.',
        ],
      ],
      [
        'file' => 'frame-3.webp',
        'caption' => 'A quiet neighborhood basking in late afternoon sun.',
        'location' => 'North Park',
        'camera' => 'Pentax K1000',
        'lens' => 'SMC Pentax-M 50mm f/2',
        'film' => 'Kodak Portra 400',
        'lab' => 'Carmencita Film Lab',
        'roll_ids' => [2, 27, 3],
        'comments' => [
          'Love the lens flare and composition!',
          'That truck just screams California.',
        ],
      ],
      [
        'file' => 'frame-4.webp',
        'caption' => 'A lone palm tree reaching into the blue sky.',
        'location' => 'Mission Bay',
        'camera' => 'Minolta X-700',
        'lens' => 'Minolta MD 45mm f/2',
        'film' => 'Kodak Ektar 100',
        'lab' => 'Richard Photo Lab',
        'roll_ids' => [3, 5, 16],
        'comments' => [
          'Clean, simple, and beautiful.',
          'Great use of negative space.',
        ],
      ],
      [
        'file' => 'frame-5.webp',
        'caption' => 'Hollywood lights glowing in the dusk.',
        'location' => 'Hollywood Blvd',
        'camera' => 'Contax G1',
        'lens' => 'Carl Zeiss 45mm f/2 Planar',
        'film' => 'Cinestill 800T',
        'lab' => 'The Find Lab',
        'roll_ids' => [7, 21, 27],
        'comments' => [
          'The neon glow is so nostalgic.',
          'Gives real film noir vibes.',
        ],
      ],
      [
        'file' => 'frame-6.webp',
        'caption' => 'Catching a wave just before sunset.',
        'location' => 'Ocean Beach',
        'camera' => 'Nikon F100',
        'lens' => 'Nikon 85mm f/1.8D',
        'film' => 'Kodak Portra 800',
        'lab' => 'Rewind Photo Lab',
        'roll_ids' => [10, 20, 8],
        'comments' => [
          'So much motion in this frame!',
          'Surf photography done right 👏',
        ],
      ],
      [
        'file' => 'frame-7.webp',
        'caption' => 'Strolling the pier with ocean breeze in the air.',
        'location' => 'Crystal Pier',
        'camera' => 'Canon EOS 3',
        'lens' => 'Canon EF 35mm f/2',
        'film' => 'Kodak Ultramax 400',
        'lab' => 'Old School Photo Lab',
        'roll_ids' => [2, 8, 9],
        'comments' => [
          'The boardwalk symmetry is on point.',
          'Love how candid this feels.',
        ],
      ],
      [
        'file' => 'frame-8.webp',
        'caption' => 'Preparing to paddle out—calm before the wave.',
        'location' => 'Del Mar Beach',
        'camera' => 'Nikon FM2',
        'lens' => 'Nikkor 50mm f/1.4',
        'film' => 'Ilford HP5 Plus 400',
        'lab' => 'The Darkroom Lab',
        'roll_ids' => [10, 20, 8],
        'comments' => [
          'You captured that anticipation perfectly!',
        ],
      ],
      [
        'file' => 'frame-9.webp',
        'caption' => 'Ready for action. Lifeguards on watch.',
        'location' => 'Mission Beach',
        'camera' => 'Canon Rebel 2000',
        'lens' => 'Canon EF 28-135mm f/3.5-5.6',
        'film' => 'Kodak ColorPlus 200',
        'lab' => 'North Coast Photo',
        'roll_ids' => [20, 28, 10],
        'comments' => [
          'This frame says “California summer.”',
          'Those red tones pop so well!',
        ],
      ],
      [
        'file' => 'frame-10.webp',
        'caption' => 'Coastal cliffs and rocky shoreline after the storm.',
        'location' => 'Sunset Cliffs',
        'camera' => 'Leica M6',
        'lens' => 'Summicron-M 35mm f/2 ASPH',
        'film' => 'Kodak Tri-X 400',
        'lab' => 'Carmencita Film Lab',
        'roll_ids' => [3, 5, 27],
        'comments' => [
          'Love the dramatic mood in this.',
          'You really captured the texture of the rocks.',
        ],
      ],
      [
        'file' => 'frame-11.webp',
        'caption' => 'Watching the sets roll in before paddling out.',
        'location' => 'San Onofre Beach',
        'camera' => 'Canon AE-1 Program',
        'lens' => 'Canon FD 50mm f/1.8',
        'film' => 'Kodak Portra 400',
        'lab' => 'The Darkroom Lab',
        'roll_ids' => [8, 10, 20],
        'comments' => [
          'That pre-surf calm hits different.',
          'Perfect composition with the shoreline.',
        ],
      ],
      [
        'file' => 'frame-12.webp',
        'caption' => 'Big Ben towering over the Thames on a bright day.',
        'location' => 'London',
        'camera' => 'Olympus Mju-II',
        'lens' => 'Olympus 35mm f/2.8',
        'film' => 'Kodak ColorPlus 200',
        'lab' => 'Filmdev UK',
        'roll_ids' => [5, 18, 27],
        'comments' => [
          'Iconic shot! Classic London vibes.',
          'Love the warmth of the ColorPlus here.',
        ],
      ],
      [
        'file' => 'frame-13.webp',
        'caption' => 'A bold red postbox tucked into a stone corner.',
        'location' => 'Edinburgh',
        'camera' => 'Nikon FM2',
        'lens' => 'Nikkor 50mm f/1.4 AI-S',
        'film' => 'Fujifilm Superia X-TRA 400',
        'lab' => 'AG Photo Lab',
        'roll_ids' => [4, 18, 27],
        'comments' => [
          'This color just jumps off the screen!',
          'So much texture in the stone.',
        ],
      ],
      [
        'file' => 'frame-14.webp',
        'caption' => 'Quiet alleyway under a tiled arch in Bermondsey.',
        'location' => 'London',
        'camera' => 'Minolta X-700',
        'lens' => 'Minolta MD 45mm f/2',
        'film' => 'Kodak Ultramax 400',
        'lab' => 'Carmencita Film Lab',
        'roll_ids' => [3, 8, 18],
        'comments' => [
          'Such cinematic vibes here.',
          'That soft grain makes this feel timeless.',
        ],
      ],
      [
        'file' => 'frame-15.webp',
        'caption' => 'Royal guard standing watch in full regalia.',
        'location' => 'Tower of London',
        'camera' => 'Pentax Spotmatic',
        'lens' => 'Super-Takumar 55mm f/1.8',
        'film' => 'Ilford HP5 Plus 400',
        'lab' => 'SilverPan Film Lab',
        'roll_ids' => [13, 28, 27],
        'comments' => [
          'Monochrome would’ve been stunning too!',
          'Iconic moment captured perfectly.',
        ],
      ],
      [
        'file' => 'frame-16.webp',
        'caption' => 'Vintage Citroën DS parked on a cobblestone street.',
        'location' => 'Clerkenwell',
        'camera' => 'Leica M6',
        'lens' => 'Summicron-M 35mm f/2 ASPH',
        'film' => 'Cinestill 50D',
        'lab' => 'Rewind Photo Lab',
        'roll_ids' => [4, 27, 12],
        'comments' => [
          'That car… absolute classic!',
          'Such elegant tones.',
        ],
      ],
      [
        'file' => 'frame-17.webp',
        'caption' => 'Fresh flowers in hand and sunlight on her face.',
        'location' => 'Bavarian countryside',
        'camera' => 'Canon A-1',
        'lens' => 'Canon FD 35mm f/2',
        'film' => 'Kodak Ektar 100',
        'lab' => 'MeinFilmLab',
        'roll_ids' => [3, 14, 20],
        'comments' => [
          'The lighting and mood are dreamy!',
        ],
      ],
      [
        'file' => 'frame-18.webp',
        'caption' => 'Wandering a quiet forest path in early autumn.',
        'location' => 'Germany',
        'camera' => 'Yashica T4',
        'lens' => 'Carl Zeiss T* Tessar 35mm f/3.5',
        'film' => 'Kodak Gold 200',
        'lab' => 'Urban Filmlab',
        'roll_ids' => [14, 20, 8],
        'comments' => [
          'So peaceful. Love the leading lines.',
        ],
      ],
      [
        'file' => 'frame-19.webp',
        'caption' => 'California pride held high on a lakeside dock.',
        'location' => 'Staffelsee',
        'camera' => 'Contax T2',
        'lens' => 'Carl Zeiss Sonnar 38mm f/2.8',
        'film' => 'Kodak Portra 160',
        'lab' => 'Old School Photo Lab',
        'roll_ids' => [1, 3, 15],
        'comments' => [
          'Beautiful backlight and crisp water reflections!',
          'This makes me want to go shoot film again.',
        ],
      ],
      [
        'file' => 'frame-20.webp',
        'caption' => 'A mountain of gourds in every color and texture.',
        'location' => 'Bauernmarkt',
        'camera' => 'Nikon F3',
        'lens' => 'Nikkor 50mm f/1.2',
        'film' => 'Kodak Ektar 100',
        'lab' => 'Carmencita Film Lab',
        'roll_ids' => [14, 29, 3],
        'comments' => [
          'So rich and detailed—fall is here 🍂',
          'Love the shallow depth of field!',
        ],
      ],
      [
        'file' => 'frame-21.webp',
        'caption' => 'Paintbrushes waiting for their next idea.',
        'location' => 'Provence',
        'camera' => 'Canon AE-1 Program',
        'lens' => 'Canon FD 50mm f/1.8',
        'film' => 'Kodak Gold 200',
        'lab' => 'The Darkroom Lab',
        'roll_ids' => [2, 14, 29],
        'comments' => [
          'So soft and peaceful!',
          'Love the tones here.',
        ],
      ],
      [
        'file' => 'frame-22.webp',
        'caption' => 'Wandering pastel alleyways in the Côte d’Azur.',
        'location' => 'Bormes-les-Mimosas',
        'camera' => 'Olympus Mju-II',
        'lens' => 'Olympus 35mm f/2.8',
        'film' => 'Kodak ColorPlus 200',
        'lab' => 'Filmdev UK',
        'roll_ids' => [3, 4, 27],
        'comments' => [
          'That orange house is a dream!',
        ],
      ],
      [
        'file' => 'frame-23.webp',
        'caption' => 'A secret courtyard tucked under Mediterranean leaves.',
        'location' => 'Gassin',
        'camera' => 'Leica M6',
        'lens' => 'Summicron-M 35mm f/2 ASPH',
        'film' => 'Cinestill 50D',
        'lab' => 'Rewind Photo Lab',
        'roll_ids' => [8, 18, 23],
        'comments' => [
          'That circular mirror is a great detail!',
        ],
      ],
      [
        'file' => 'frame-24.webp',
        'caption' => 'A white cat relaxing in a centuries-old fountain.',
        'location' => 'Saint-Tropez',
        'camera' => 'Minolta X-700',
        'lens' => 'Minolta MD 45mm f/2',
        'film' => 'Kodak Ultramax 400',
        'lab' => 'Carmencita Film Lab',
        'roll_ids' => [6, 9, 14],
        'comments' => [
          'The cat chose the perfect spot.',
          'Feels ancient and serene.',
        ],
      ],
      [
        'file' => 'frame-25.webp',
        'caption' => 'Sunlit alley cutting through pastel facades.',
        'location' => 'Collobrières',
        'camera' => 'Nikon F3',
        'lens' => 'Nikkor 50mm f/1.2',
        'film' => 'Kodak Ektar 100',
        'lab' => 'Old School Photo Lab',
        'roll_ids' => [5, 18, 27],
        'comments' => [
          'Those tones are *chef’s kiss*.',
        ],
      ],
      [
        'file' => 'frame-26.webp',
        'caption' => 'Ripening olives catching the Provençal sun.',
        'location' => 'La Croix-Valmer',
        'camera' => 'Canon A-1',
        'lens' => 'Canon FD 35mm f/2',
        'film' => 'Kodak Ektar 100',
        'lab' => 'MeinFilmLab',
        'roll_ids' => [3, 14, 25],
        'comments' => [
          'Love the textures and depth.',
        ],
      ],
      [
        'file' => 'frame-27.webp',
        'caption' => 'Climbing stone steps under a canopy of green.',
        'location' => 'Ramatuelle',
        'camera' => 'Yashica T4',
        'lens' => 'Carl Zeiss T* Tessar 35mm f/3.5',
        'film' => 'Fujifilm Superia X-TRA 400',
        'lab' => 'Urban Filmlab',
        'roll_ids' => [4, 18, 20],
        'comments' => [
          'Such a charming little path.',
        ],
      ],
      [
        'file' => 'frame-28.webp',
        'caption' => 'Potted plants and pastel homes—village life.',
        'location' => 'Gassin',
        'camera' => 'Nikon FM2',
        'lens' => 'Nikkor 50mm f/1.4 AI-S',
        'film' => 'Kodak Portra 400',
        'lab' => 'The Find Lab',
        'roll_ids' => [3, 20, 27],
        'comments' => [
          'So cozy. Could live here forever!',
        ],
      ],
      [
        'file' => 'frame-29.webp',
        'caption' => 'Afternoon stroll through the village heart.',
        'location' => 'Grimaud',
        'camera' => 'Pentax Spotmatic',
        'lens' => 'Super-Takumar 55mm f/1.8',
        'film' => 'Ilford HP5 Plus 400',
        'lab' => 'SilverPan Film Lab',
        'roll_ids' => [10, 13, 14],
        'comments' => [
          'Lovely mix of locals and tourists.',
        ],
      ],
      [
        'file' => 'frame-30.webp',
        'caption' => 'A mint Vespa resting beside a quiet Provencal home.',
        'location' => 'Ramatuelle',
        'camera' => 'Contax T2',
        'lens' => 'Carl Zeiss Sonnar 38mm f/2.8',
        'film' => 'Kodak Portra 160',
        'lab' => 'Carmencita Film Lab',
        'roll_ids' => [3, 18, 25],
        'comments' => [
          'That Vespa color is so fresh!',
          'Perfect lines and light.',
        ],
      ],

      [
        'file' => 'frame-31.webp',
        'caption' => 'A tall palm soaking up the southern French sun.',
        'location' => 'Saint-Tropez',
        'camera' => 'Yashica T4',
        'lens' => 'Carl Zeiss Tessar 35mm f/3.5',
        'film' => 'Kodak Ektar 100',
        'lab' => 'MeinFilmLab',
        'roll_ids' => [3, 20, 28],
        'comments' => [
          'Gorgeous sky and subtle tones.',
        ],
      ],
      [
        'file' => 'frame-32.webp',
        'caption' => 'A winding road through Saint-Tropez\'s calm streets and lush greenery.',
        'location' => 'Saint-Tropez',
        'camera' => 'Olympus OM-1',
        'lens' => 'Zuiko 50mm f/1.8',
        'film' => 'Kodak Gold 200',
        'lab' => 'Rewind Photo Lab',
        'roll_ids' => [4, 9, 14],
        'comments' => [
          'Peaceful composition.',
          'Love the light!',
        ],
      ],
      [
        'file' => 'frame-33.webp',
        'caption' => 'Poster from a bus stop frozen in the past.',
        'location' => 'Berlin',
        'camera' => 'Leica M6',
        'lens' => 'Summicron-M 50mm f/2',
        'film' => 'Cinestill 800T',
        'lab' => 'The Find Lab',
        'roll_ids' => [2, 21, 30],
        'comments' => [
          'Clever framing!',
          'Very cinematic.',
        ],
      ],
      [
        'file' => 'frame-34.webp',
        'caption' => 'A lone fir rising through the tangle of branches.',
        'location' => 'Bavaria',
        'camera' => 'Minolta SRT-101',
        'lens' => 'Rokkor-X 45mm f/2',
        'film' => 'Fujifilm Superia X-TRA 400',
        'lab' => 'Urban Filmlab',
        'roll_ids' => [10, 14, 26],
        'comments' => [
          'Looks like a Christmas card.',
        ],
      ],
      [
        'file' => 'frame-35.webp',
        'caption' => 'A charming alleyway lined with bicycles and cozy cafes.',
        'location' => 'Munich',
        'camera' => 'Contax G2',
        'lens' => 'Carl Zeiss Planar 45mm f/2',
        'film' => 'Kodak Portra 160',
        'lab' => 'Carmencita Film Lab',
        'roll_ids' => [1, 12, 24],
        'comments' => [
          'Inviting and peaceful.',
          'Love the symmetry!',
        ],
      ],
      [
        'file' => 'frame-36.webp',
        'caption' => 'Close-up of the golden clock tower glinting in the midday sun.',
        'location' => 'Munich',
        'camera' => 'Nikon F3',
        'lens' => 'Nikkor 50mm f/1.4',
        'film' => 'Kodak Ektachrome E100',
        'lab' => 'Old School Photo Lab',
        'roll_ids' => [6, 17, 23],
        'comments' => [
          'Those colors pop!',
        ],
      ],
      [
        'file' => 'frame-37.webp',
        'caption' => 'Dramatic shadows and lines on a pedestrian bridge in Munich.',
        'location' => 'Munich',
        'camera' => 'Canonet QL17 GIII',
        'lens' => '40mm f/1.7',
        'film' => 'Ilford HP5 Plus 400',
        'lab' => 'MeinFilmLab',
        'roll_ids' => [13, 19, 22],
        'comments' => [
          'Great use of depth.',
          'So graphic and bold!',
        ],
      ],
      [
        'file' => 'frame-38.webp',
        'caption' => 'Ferris wheel spinning on the edge of Lake Geneva.',
        'location' => 'Geneva',
        'camera' => 'Pentax K1000',
        'lens' => 'SMC Pentax-M 50mm f/2',
        'film' => 'Kodak Ultramax 400',
        'lab' => 'Canadian Film Lab',
        'roll_ids' => [3, 5, 12],
        'comments' => [
          'So nostalgic!',
        ],
      ],
      [
        'file' => 'frame-39.webp',
        'caption' => 'Clear skies and blue waters meeting in Geneva\'s lakeside calm.',
        'location' => 'Geneva',
        'camera' => 'Canon A-1',
        'lens' => 'Canon FD 28mm f/2.8',
        'film' => 'Fujifilm Pro 400H',
        'lab' => 'Rewind Photo Lab',
        'roll_ids' => [8, 11, 15],
        'comments' => [
          'That water is unreal.',
          'Such a soothing palette.',
        ],
      ],
      [
        'file' => 'frame-40.webp',
        'caption' => 'Paddle steamer Belle Époque docked on Lake Geneva with flowers in the foreground.',
        'location' => 'Geneva',
        'camera' => 'Canon AE-1',
        'lens' => 'Canon FD 50mm f/1.8',
        'film' => 'Kodak Portra 400',
        'lab' => 'Carmencita Film Lab',
        'roll_ids' => [4, 12, 18],
        'comments' => [
          'Incredible clarity and tones!',
          'Classic Swiss scene.',
        ],
      ],
      [
        'file' => 'frame-41.webp',
        'caption' => 'Carousel and cafés by the lake',
        'location' => 'Geneva',
        'camera' => 'Olympus OM-1',
        'lens' => 'Zuiko 50mm f/1.8',
        'film' => 'Kodak Gold 200',
        'lab' => 'Urban Photo Lab',
        'roll_ids' => [1, 6],
        'comments' => ['Love the atmosphere.', 'Pure summer energy.'],
      ],
      [
        'file' => 'frame-42.webp',
        'caption' => 'Clouds drifting over the Geneva skyline',
        'location' => 'Geneva',
        'camera' => 'Canon AE-1',
        'lens' => 'Canon FD 28mm f/2.8',
        'film' => 'Kodak Portra 400',
        'lab' => 'Carmencita Film Lab',
        'roll_ids' => [1, 4],
        'comments' => ['The ferris wheel adds charm.', 'Beautiful composition.'],
      ],
      [
        'file' => 'frame-43.webp',
        'caption' => 'Ornate rooftops and classic facades',
        'location' => 'Lausanne',
        'camera' => 'Nikon FM2',
        'lens' => 'Nikkor 50mm f/1.8',
        'film' => 'Fujicolor C200',
        'lab' => 'Mein Film Lab',
        'roll_ids' => [3],
        'comments' => ['Love the textures.', 'So much character!'],
      ],
      [
        'file' => 'frame-44.webp',
        'caption' => 'Signs of culture on a sunny walk',
        'location' => 'Geneva',
        'camera' => 'Minolta X-700',
        'lens' => 'Minolta MD 45mm f/2',
        'film' => 'Kodak Ultramax 400',
        'lab' => 'Nation Photo',
        'roll_ids' => [2, 5],
        'comments' => ['Great colors!', 'This feels like summer.'],
      ]
    ];


    // Loop through the frames data
    foreach ($framesSeedData as $index => $frameData) {
      // random user id
      $userId = random_int(1, 10);

      // Retrieve the user by their ID
      $user = User::find($userId);

      // generate a unique filename (before the creation to have matching filename and db entry)
      $filename = Str::uuid() . ".webp";

      // creation of the user
      $frame = Frame::create([
        'user_id' => $userId,
        'caption' => $frameData['caption'],
        'location' => $frameData['location'],
        'slug' => Frame::generateSlug($user->username, $frameData['caption']),
        'image' => $filename,
        'camera' => $frameData['camera'],
        'lens' => $frameData['lens'],
        'film' => $frameData['film'],
        'lab' => $frameData['lab'],
        'created_at' => now()->addSeconds($index),
        'updated_at' => now()->addSeconds($index),
      ]);

      // path of the placeholder image
      $sourcePath = database_path('seeders/placeholder/frame/' . $frameData['file']);

      // path of where the image should be stored
      $destinationPath = 'media/images/' . $userId;

      // save the placeholder file in the media user folder
      Storage::putFileAs($destinationPath, $sourcePath, $filename);

      // Attach rolls to the frame
      $frame->rolls()->sync($frameData['roll_ids']);

      // Loop through the comments data
      foreach ($frameData['comments'] as $commentText) {
        // creation of the comment
        Comment::create([
          'text' => $commentText,
          'frame_id' => $frame->id,
          'user_id' => random_int(1, 10),
        ]);
      }
    }
  }
}
