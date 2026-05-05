<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class TattooPostSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener ID del usuario admin (primero que exista)
        $admin = User::where('role', 'admin')->first() 
                  ?? User::first();

        if (!$admin) {
            echo "⚠️  No hay usuarios en la BD. Crea uno primero.\n";
            return;
        }

        // Obtener IDs de categorías de tatuaje
        $diseños = Category::where('name', 'Diseños')->first()?->id;
        $información = Category::where('name', 'Información')->first()?->id;
        $misTatuajes = Category::where('name', 'Mis Tatuajes')->first()?->id;
        $ayuda = Category::where('name', 'Ayuda')->first()?->id;
        // $tecnicas = Category::where('name', 'Old School - Técnicas')->first()?->id;
        // $historia = Category::where('name', 'Old School - Significados e Historia')->first()?->id;

        $posts = [
            [
                'title' => 'El Ancla: Símbolo de Estabilidad en Old School',
                'content' => 'Las anclas son uno de los tatuajes más icónicos del estilo old school. Originarias de la tradición marinera, representan estabilidad, fuerza y conexión con el mar. Los marineros se los tatuaban como buena suerte antes de zarpar. El diseño clásico incluye líneas gruesas, colores sólidos (rojo, azul, negro) y una cuerda enrollada alrededor.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Ancla+Old+School'
            ],
            [
                'title' => 'Barcos & Veleros: Navegando la Historia del Tatuaje',
                'content' => 'Los barcos veleros son un clásico del old school tattoo. Representan aventura, viaje y exploración. Cada marinero llevaba su propio barco tatuado, a menudo con el nombre de su nave. El estilo tradicional usa líneas gruesas, colores limitados y una composición simple pero poderosa. ¿Cuál es tu barco favorito?',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Barco+Velero'
            ],
            [
                'title' => 'El Águila: Poder y Libertad en la Tinta',
                'content' => 'Las águilas son símbolos de poder, libertad y visión. En el old school, se representan con las alas desplegadas en toda su majestuosidad. Los detalles se logran con líneas gruesas y sombreado simple. Un clásico que nunca pasa de moda. Muchos militares eligieron este tatuaje como símbolo de protección.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Aguila'
            ],
            [
                'title' => 'Serpientes y Dragones: Misterio en el Old School',
                'content' => 'Las serpientes representan transformación y renovación. En el estilo old school, se dibujan con escamas detalladas y expresiones amenazantes. A menudo envuelven otros elementos como dagas o corazones. Los dragones, aunque menos frecuentes que las serpientes, añaden un toque oriental al tradicional western style.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Serpiente'
            ],
            [
                'title' => 'Calaveras Mexicanas: Celebrando la Vida y la Muerte',
                'content' => 'Las calaveras son un símbolo poderoso de la cultura mexicana. En el old school, se representan con mandíbulas grandes, ojos vacios y ornamentación floral. Celebran la vida después de la muerte y la aceptación del ciclo vital. Este tatuaje combina belleza con un mensaje profundo sobre la mortalidad.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Calavera'
            ],
            [
                'title' => 'Calaveras con Rosas: Dualidad de Belleza y Oscuridad',
                'content' => 'La combinación de calaveras y rosas crea una dualidad fascinante: la belleza del amor y la inevitabilidad de la muerte. Este pairing es muy popular en tatuajes old school. Las rosas envuelven o emergen de la calavera, creando una composición armónica que es tanto linda como profunda.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Calavera+Rosa'
            ],
            [
                'title' => 'Las Rosas Rojas: Amor, Pasión y Sacrificio',
                'content' => 'Las rosas son flores clásicas en tatuajes old school. El rojo simboliza pasión y amor, el rosa representa ternura. Se dibujan con pétalos detallados pero manteniendo líneas gruesas característicos del estilo. Muchas veces enlazan nombres o se dedican a personas especiales.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Rosa+Roja'
            ],
            [
                'title' => 'Flores y Naturaleza: El Lado Femenino del Old School',
                'content' => 'Aunque el old school era dominado por marineros (mayormente hombres), las flores siempre tuvieron su lugar. Margaritas, girasoles y flores silvestres añaden un toque delicado. La combinación de flores con elementos más duros (dagas, calaveras) crea contraste y complejidad visual.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Flores'
            ],
            [
                'title' => 'El Corazón Atravesado: Amor y Dolor',
                'content' => 'Un corazón atravesado por una daga o flecha es la representación visual del dolor emocional. Este motivo aparece constantemente en el old school y representa tanto el amor perdido como la fortaleza emocional. Las líneas gruesas y los colores fuertes (rojo intenso) lo hacen inconfundible.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Corazon+Daga'
            ],
            [
                'title' => 'Flechas y Cupido: Simbolismo Romántico',
                'content' => 'Las flechas Cupido y los corazones atravesados son símbolos del amor en la tradición old school. Pueden estar solos o acompañados de nombres, fechas o quotes. El simplismo del diseño permite que sea versátil y personal para cada portador.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Flecha+Cupido'
            ],
            [
                'title' => 'Agujas y Técnicas en Old School: Color de Tinta Limitado',
                'content' => 'La técnica clásica old school utiliza solo 5-6 colores base: negro, rojo, verde, amarillo, azul y piel. Las líneas son gruesas (entre 2-4mm) para asegurar que el tatuaje envejecezca bien. La ausencia de degradados y sombras complejas hace que estos tatuajes sean duraderos y claros incluso después de años.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Tecnicas'
            ],
            [
                'title' => 'Proporción y Composición: El Arte de Colocar un Tattoo',
                'content' => 'En el old school, la composición es clave. Los elementos se colocan respetando el cuerpo, aprovechando la forma natural del músculo o el hueso. Las proporciones son simples pero efectivas: líneas gruesas, poco detalle, máximo impacto visual. Esto contrasta con estilos modernos que buscan fotorrealismo.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Composicion'
            ],
            [
                'title' => 'Orígenes del Old School: La Era Dorada de los Marineros',
                'content' => 'El tatuaje old school tiene sus raíces en las tradiciones marineras del siglo XIX. Los marineros se tatuaban para marcar viajes, sobrevivencias y logros. Cada símbolo tenía un significado: una golondrina por cada 5000 millas navegadas, un ancla para la seguridad, un cerdo y un gallo para protección en caso de naufragio.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Historia'
            ],
            [
                'title' => 'De los Militares a la Cultura Pop: Evolución del Old School',
                'content' => 'Después de los marineros, los militares adoptaron el estilo old school. Los tatuajes representaban unidad, orgullo militar y patriotismo. Hoy en día, vemos el resurgimiento del old school en la cultura pop, con celebridades y artistas eligiendo este estilo atemporal sobre tendencias passateras.',
                'category_id' => $información,
                'user_id' => $admin->id,
                'habilitated' => true,
                'poster_url' => 'https://via.placeholder.com/300x300?text=Evolucion'
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }

        echo "✅ " . count($posts) . " posts de tatuajes old school creados!\n";
    }
}
