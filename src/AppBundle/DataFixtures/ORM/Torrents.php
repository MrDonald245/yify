<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 12/12/17
 * Time: 12:40
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Torrent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class Torrents extends Fixture
{
    /**
     * @var String[][]
     */
    private $magnetLinks;

    /**
     * Torrents constructor.
     */
    public function __construct() {
        $this->magnetLinks = [
            [
                'magnet:?xt=urn:btih:PEDMWAHCJQUFG6DYRRCWZMGJX5OYP3R2&dn=Revolt+(2017)+720p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce',
                'magnet:?xt=urn:btih:M7QQBUKGEXD3BZZC63JYQTXWJZB44OBZ&dn=Revolt+(2017)+1080p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce'
            ],
            [
                'magnet:?xt=urn:btih:HYZYFVLPBOEI5JM6PBS2IWDRNQRHC5OR&dn=Goon:+Last+of+the+Enforcers+(2017)+720p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce',
                'magnet:?xt=urn:btih:ZDRXL3MXGQIOQJNTJ2H6WAGN2KBF6N3O&dn=Goon:+Last+of+the+Enforcers+(2017)+1080p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce'
            ],
            [
                'magnet:?xt=urn:btih:YDO2SNWKCGAYGU5CKTOFGRKJSZRP7DZC&dn=A+Ghost+Story+(2017)+720p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce',
                'magnet:?xt=urn:btih:SX5SRMHXNLJSZOX2IZOI27DGYIJ2H3R3&dn=A+Ghost+Story+(2017)+1080p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce'
            ],
            [
                'magnet:?xt=urn:btih:6W4GCAKIJXRIPFRNEH3YA2BEZB5JYAKX&dn=The+Bad+Batch+(2016)+720p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce',
                'magnet:?xt=urn:btih:3YSFAHC6ETF27BMYK4AF7CDG7EIUY4X7&dn=The+Bad+Batch+(2016)+1080p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce'
            ],
            [
                'magnet:?xt=urn:btih:BNIKOUHAZT2Z2DPFMCLL6TOSTYNWSJDZ&dn=Certain+Women+(2016)+720p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce',
                'magnet:?xt=urn:btih:MTPPVQUKNKDBO3PZBGNMPWXNAP4THSF6&dn=Certain+Women+(2016)+1080p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce'
            ],
            [
                'magnet:?xt=urn:btih:EA4E25XNT5VBQIYWIJTZT2ZA4TG22SHW&dn=Despicable+Me+3+(2017)+720p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce',
                'magnet:?xt=urn:btih:JEJKZQ2OJ35LGQB4JF6MEJHUTZMCYDR7&dn=Despicable+Me+3+(2017)+1080p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce'
            ],
            [
                'magnet:?xt=urn:btih:EA4E25XNT5VBQIYWIJTZT2ZA4TG22SHW&dn=Despicable+Me+3+(2017)+720p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce',
                'magnet:?xt=urn:btih:JEJKZQ2OJ35LGQB4JF6MEJHUTZMCYDR7&dn=Despicable+Me+3+(2017)+1080p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce'
            ],
            [
                'magnet:?xt=urn:btih:RBT7H3RQUDJMLEL7UTJJC32TZL66N7XT&dn=47+Meters+Down+(2017)+720p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce',
                'magnet:?xt=urn:btih:6NAFZCSP2N3VVEFMHJJAUHU66ECH2TR2&dn=47+Meters+Down+(2017)+1080p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce'
            ],
            [
                'magnet:?xt=urn:btih:DJPR6XR6QPRZW3LXEVG76ZNPYASUSEQV&dn=Transformers:+The+Last+Knight+(2017)+720p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce',
                'magnet:?xt=urn:btih:Q2SLKXYNYAK73CDNE2NWVGOHXGH3VSXL&dn=Transformers:+The+Last+Knight+(2017)+1080p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce'
            ],
            [
                'magnet:?xt=urn:btih:4UMZBHRBRQHTRVVBCNRP7Q4XNPTM2V6A&dn=The+Big+Sick+(2017)+720p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce',
                'magnet:?xt=urn:btih:4VSCPTJYFCJ547M4SBXR6FL6EKK6JPOY&dn=The+Big+Sick+(2017)+1080p+BrRip+x264+YIFY&tr=udp://tracker.zer0day.to:1337/announce&tr=udp://tracker.coppersurfer.tk:6969/announce&tr=udp://mgtracker.org:6969/announce&tr=udp://tracker.leechers-paradise.org:6969/announce&tr=udp://tracker.sktorrent.net:6969/announce&tr=udp://explodie.org:6969/announce'
            ],
        ];
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load(ObjectManager $manager) {
        $t_dir = $this->container->getParameter(
                'kernel.project_dir') . '/web/torrents';

        for ($i = 0; $i < 10; ++$i) {
            $n = $i + 1;

            $torrent_file720 = new File($t_dir . '/torrent' . $n . '-720p.torrent');
            $torrent_file1080 = new File($t_dir . '/torrent' . $n . '-1080p.torrent');

            $torrent720 = new Torrent();
            $torrent720->setFile($torrent_file720)
                ->setFileName($torrent_file720->getFilename())
                ->setMagnetLink($this->magnetLinks[$i][0])
                ->setQuality($this->getReference('quality_quality_720'));

            $torrent_1080 = new Torrent();
            $torrent_1080->setFile($torrent_file1080)
                ->setFileName($torrent_file1080->getFilename())
                ->setMagnetLink($this->magnetLinks[$i][1])
                ->setQuality($this->getReference('quality_quality_1080'));

            $manager->persist($torrent720);
            $manager->persist($torrent_1080);

            $this->addReference('torrent' . $n . '-720p', $torrent720);
            $this->addReference('torrent' . $n . '-1080p', $torrent_1080);
        }

        $manager->flush();
    }
}