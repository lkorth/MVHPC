<?php

namespace MVHPC {

    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    class Archives {

        public function index(Application $app, Request $request) {
            $response = new Response($app['twig']->render('archives.twig', array('page' => 'archives')));
            $response->setPublic();
            $response->setEtag(md5($response->getContent()));
            $response->isNotModified($request);

            return $response;
        }

        public function secondaryDocuments(Application $app, Request $request) {
            $response = new Response($app['twig']->render('archives.secondary-documents.twig', array('page' => 'archives')));
            $response->setPublic();
            $response->setEtag(md5($response->getContent()));
            $response->isNotModified($request);

            return $response;
        }

        public function images(Application $app, Request $request, $terms, $page) {
            global $js, $css;

            $arr = array();
            $arr['page'] = 'archives';
            $arr['terms'] = $terms;

            if(!empty($terms)) {
                $db = \Database::getDatabase();
                $result = $db->query("SELECT thumbnail,id, MATCH(tags, information) AGAINST('$terms') AS score FROM search WHERE MATCH(tags, information) AGAINST('$terms') and live = '1' ORDER BY score DESC, views DESC");
                $num = $db->numRows($result) ? $db->numRows($result) : 0;

                if ($num == 0) {
                    $result = $db->query("SELECT thumbnail,id FROM search WHERE live = '1' and (tags LIKE '%$terms%' OR information LIKE '%$terms%') ORDER BY views DESC");
                    $num = $db->numRows($result) ? $db->numRows($result) : 0;
                    if ($num == 0) {
                        $noResults = "<p class='body_text'>No results found for the search \"" . $terms . "\".&nbsp;&nbsp;Please try a different search.</p>";
                    }
                }

                $arr['count'] = $num;

                $pager = new \Pager($page, 16, $num);
                $pager->calculate();

                $cnt = 0;
                for ($i = $pager->firstRecord; $i <= $pager->lastRecord; $i++) {
                    $arr['images'][$cnt]['thumbnail'] = mysql_result($result, $i, "thumbnail");
                    $arr['images'][$cnt]['id'] = mysql_result($result, $i, "id");
                    $cnt++;
                }

                $arr['paging'] = renderPaging($pager, '/archives/images/' . $terms, true);
            }

            array_push($js, 'jquery-bgiframe-min.js',
                'jquery-ajaxQueue.js',
                'jquery-autocomplete.js',
                'inpage_script.js');
            $arr['js'] = $js;
            array_push($css, 'jquery-autocomplete.css');
            $arr['css'] = $css;

            $response = new Response($app['twig']->render('archives.images.twig', $arr));
            $response->setPublic();
            $response->setEtag(md5($response->getContent()));
            $response->isNotModified($request);

            return $response;
        }
    }
}