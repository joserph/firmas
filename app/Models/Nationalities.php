<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationalities extends Model
{
    use HasFactory;

    public static function getNationalities()
    {
        return [
            'AFGANA'                => __('AFGANA'),
            'ALBANESA'              => __('ALBANESA'),
            'ALEMANA'               => __('ALEMANA'),
            'ANDORRANA'             => __('ANDORRANA'),
            'ANGOLEÑA'              => __('ANGOLEÑA'),
            'ANTIGÜEÑA Y BARBUDA'   => __('ANTIGÜEÑA Y BARBUDA'),
            'ARGENTINA'             => __('ARGENTINA'),
            'ARMENIA'               => __('ARMENIA'),
            'ARUBEÑA'               => __('ARUBEÑA'),
            'AUSTRALIANA'           => __('AUSTRALIANA'),
            'AUSTRÍACA'             => __('AUSTRÍACA'),
            'AZERBAIYANA'           => __('AZERBAIYANA'),
            'BAHAMEÑA'              => __('BAHAMEÑA'),
            'BAHAMEÑO'              => __('BAHAMEÑO'),
            'BANGLADESÍ'            => __('BANGLADESÍ'),
            'BARBADENSE'            => __('BARBADENSE'),
            'BELGA'                 => __('BELGA'),
            'BELICEÑA'              => __('BELICEÑA'),
            'BENINESA'              => __('BENINESA'),
            'BERMUDEÑA'             => __('BERMUDEÑA'),
            'BIELORRUSA'            => __('BIELORRUSA'),
            'BIRMANA'               => __('BIRMANA'),
            'BOLIVIANA'             => __('BOLIVIANA'),
            'BOSNIA Y HERZEGOVINA'  => __('BOSNIA Y HERZEGOVINA'),
            'BOTSUANA'              => __('BOTSUANA'),
            'BRASILEÑA'             => __('BRASILEÑA'),
            'BRITÁNICA'             => __('BRITÁNICA'),
            'BRUNESA'               => __('BRUNESA'),
            'BÚLGARA'               => __('BÚLGARA'),
            'BURKINESA'             => __('BURKINESA'),
            'BURUNDESA'             => __('BURUNDESA'),
            'BUTANESA'              => __('BUTANESA'),
            'CABOVERDIANA'          => __('CABOVERDIANA'),
            'CAMBOYANA'             => __('CAMBOYANA'),
            'CAMERUNESA'            => __('CAMERUNESA'),
            'CANADIENSE'            => __('CANADIENSE'),
            'CATARI'                => __('CATARI'),
            'CENTROAFRICANA'        => __('CENTROAFRICANA'),
            'CHADIANA'              => __('CHADIANA'),
            'CHECA'                 => __('CHECA'),
            'CHILENA'               => __('CHILENA'),
            'CHINA'                 => __('CHINA'),
            'CHIPRIOTA'             => __('CHIPRIOTA'),
            'COLOMBIANA'            => __('COLOMBIANA'),
            'COMORENSE'             => __('COMORENSE'),
            'CONGOLEÑA'             => __('CONGOLEÑA'),
            'COSTARRICENSE'         => __('COSTARRICENSE'),
            'CROATA'                => __('CROATA'),
            'CUBANA'                => __('CUBANA'),
            'DANESA'                => __('DANESA'),
            'DOMINIQUESA'           => __('DOMINIQUESA'),
            // 'ECUATORIANA'           => __('ECUATORIANA'),
            'EGIPCIA'               => __('EGIPCIA'),
            'EMIRATÍ'               => __('EMIRATÍ'),
            'ERITREA'               => __('ERITREA'),
            'ESLOVACA'              => __('ESLOVACA'),
            'ESLOVENA'              => __('ESLOVENA'),
            'ESPAÑOLA'              => __('ESPAÑOLA'),
            'ESTADOUNIDENSE'        => __('ESTADOUNIDENSE'),
            'ESTONIA'               => __('ESTONIA'),
            'ETÍOPE'                => __('ETÍOPE'),
            'FILIPINA'              => __('FILIPINA'),
            'FINLANDESA'            => __('FINLANDESA'),
            'FIYIANA'               => __('FIYIANA'),
            'FRANCESA'              => __('FRANCESA'),
            'GABONESA'              => __('GABONESA'),
            'GALESA'                => __('GALESA'),
            'GHANESA'               => __('GHANESA'),
            'GRANADINA'             => __('GRANADINA'),
            'GRIEGA'                => __('GRIEGA'),
            'GUATEMALTECA'          => __('GUATEMALTECA'),
            'GUINEANA'              => __('GUINEANA'),
            'GUINEANA ECUATORIAL'   => __('GUINEANA ECUATORIAL'),
            'GUYANESA'              => __('GUYANESA'),
            'HAITIANA'              => __('HAITIANA'),
            'HOLANDESA'             => __('HOLANDESA'),
            'HONDUREÑA'             => __('HONDUREÑA'),
            'HÚNGARA'               => __('HÚNGARA'),
            'INDIA'                 => __('INDIA'),
            'INDONESIA'             => __('INDONESIA'),
            'INGLESA'               => __('INGLESA'),
            'IRANÍ'                 => __('IRANÍ'),
            'IRAQUÍ'                => __('IRAQUÍ'),
            'IRLANDESA'             => __('IRLANDESA'),
            'ISLANDESA'             => __('ISLANDESA'),
            'ISRAELÍ'               => __('ISRAELÍ'),
            'ITALIANA'              => __('ITALIANA'),
            'JAMAICANA'             => __('JAMAICANA'),
            'JAPONESA'              => __('JAPONESA'),
            'JORDANA'               => __('JORDANA'),
            'KAZAJA'                => __('KAZAJA'),
            'KENIANA'               => __('KENIANA'),
            'KIRGUISA'              => __('KIRGUISA'),
            'KIRIBATIANA'           => __('KIRIBATIANA'),
            'KUWAITÍ'               => __('KUWAITÍ'),
            'LAOSIANA'              => __('LAOSIANA'),
            'LESOTENSE'             => __('LESOTENSE'),
            'LETONA'                => __('LETONA'),
            'LIBANESA'              => __('LIBANESA'),
            'LIBERIANA'             => __('LIBERIANA'),
            'LIBIA'                 => __('LIBIA'),
            'LIECHTENSTEINENSE'     => __('LIECHTENSTEINENSE'),
            'LITUANA'               => __('LITUANA'),
            'LUXEMBURGUESA'         => __('LUXEMBURGUESA'),
            'MACEDONIA'             => __('MACEDONIA'),
            'MALASIA'               => __('MALASIA'),
            'MALAUÍ'                => __('MALAUÍ'),
            'MALDIVA'               => __('MALDIVA'),
            'MALIENSE'              => __('MALIENSE'),
            'MALTESA'               => __('MALTESA'),
            'MARFILEÑA'             => __('MARFILEÑA'),
            'MARROQUÍ'              => __('MARROQUÍ'),
            'MAURICIANA'            => __('MAURICIANA'),
            'MAURITANA'             => __('MAURITANA'),
            'MEXICANA'              => __('MEXICANA'),
            'MICRONESIA'            => __('MICRONESIA'),
            'MOLDAVA'               => __('MOLDAVA'),
            'MONEGASCA'             => __('MONEGASCA'),
            'MONGOLA'               => __('MONGOLA'),
            'MONTENEGRINA'          => __('MONTENEGRINA'),
            'MOZAMBIQUEÑA'          => __('MOZAMBIQUEÑA'),
            'NAMIBIA'               => __('NAMIBIA'),
            'NAURUANA'              => __('NAURUANA'),
            'NEERLANDESA'           => __('NEERLANDESA'),
            'NEOZELANDESA'          => __('NEOZELANDESA'),
            'NEPALÍ'                => __('NEPALÍ'),
            'NICARAGÜENSE'          => __('NICARAGÜENSE'),
            'NIGERIANA'             => __('NIGERIANA'),
            'NIGERINA'              => __('NIGERINA'),
            'NORCOREANA'            => __('NORCOREANA'),
            'NORUEGA'               => __('NORUEGA'),
            'OMANÍ'                 => __('OMANÍ'),
            'PAKISTÁN'              => __('PAKISTÁN'),
            'PALAOS'                => __('PALAOS'),
            'PALESTINA'             => __('PALESTINA'),
            'PANAMEÑA'              => __('PANAMEÑA'),
            'PAPÚ'                  => __('PAPÚ'),
            'PARAGUAYA'             => __('PARAGUAYA'),
            'PERUANA'               => __('PERUANA'),
            'POLACA'                => __('POLACA'),
            'PORTUGUESA'            => __('PORTUGUESA'),
            'PUERTORRIQUEÑA'        => __('PUERTORRIQUEÑA'),
            'RUANDESA'              => __('RUANDESA'),
            'RUMANA'                => __('RUMANA'),
            'RUSA'                  => __('RUSA'),
            'SALOMONENSE'           => __('SALOMONENSE'),
            'SALVADOREÑA'           => __('SALVADOREÑA'),
            'SAMOANA'               => __('SAMOANA'),
            'SANMARINENSE'          => __('SANMARINENSE'),
            'SANTALUCENSE'          => __('SANTALUCENSE'),
            'SANTOTOMENSE'          => __('SANTOTOMENSE'),
            'SAUDITA'               => __('SAUDITA'),
            'SENEGALESA'            => __('SENEGALESA'),
            'SERBIA'                => __('SERBIA'),
            'SEYCHELLENSE'          => __('SEYCHELLENSE'),
            'SIERRA LEONESA'        => __('SIERRA LEONESA'),
            'SINGAPURENSE'          => __('SINGAPURENSE'),
            'SIRIA'                 => __('SIRIA'),
            'SOMALÍ'                => __('SOMALÍ'),
            'SUDAFRICANA'           => __('SUDAFRICANA'),
            'SUDANESA'              => __('SUDANESA'),
            'SUECA'                 => __('SUECA'),
            'SUIZA'                 => __('SUIZA'),
            'SURINAMESA'            => __('SURINAMESA'),
            'SWAZILANDESA'          => __('SWAZILANDESA'),
            'TAILANDESA'            => __('TAILANDESA'),
            'TANZANA'               => __('TANZANA'),
            'TAYIKA'                => __('TAYIKA'),
            'TIMORENSE'             => __('TIMORENSE'),
            'TOGOLÉS'               => __('TOGOLÉS'),
            'TONGANA'               => __('TONGANA'),
            'TRINITENSE'            => __('TRINITENSE'),
            'TUNECINA'              => __('TUNECINA'),
            'TURCA'                 => __('TURCA'),
            'TURCOMANA'             => __('TURCOMANA'),
            'TUVALUANA'             => __('TUVALUANA'),
            'UCRANIANA'             => __('UCRANIANA'),
            'UGANDESA'              => __('UGANDESA'),
            'URUGUAYA'              => __('URUGUAYA'),
            'UZBEKA'                => __('UZBEKA'),
            'VANUATENSE'            => __('VANUATENSE'),
            'VATICANO'              => __('VATICANO'),
            'VENEZOLANA'            => __('VENEZOLANA'),
            'VIETNAMITA'            => __('VIETNAMITA'),
            'YEMENÍ'                => __('YEMENÍ'),
            'YIBUTIANA'             => __('YIBUTIANA'),
            'ZAMBIANA'              => __('ZAMBIANA'),
            'ZIMBABUENSE'           => __('ZIMBABUENSE'),
        ];
    }
}
