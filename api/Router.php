<?php

class Router {
    public function processRequest(Request $request): Response {
        $page = isset($_GET['route']) ? $_GET['route'] : '';
      
        switch($page) {

            
            case '/account':
                $controler = new AccountApiControler();
                switch($request->getMethod()) {
                    case 'GET':
                        return $controler->proceedListAccounts($request);
                    case 'POST':
                        return $controler->proceedCreateAccount($request);
                    case 'PUT':
                        return $controler->proceedUpdateAccount($request);
                    case 'DELETE':
                        return $controler->proceedDeleteAccount($request);
                }
               
            case '/article':
                $controler = new ArticleApiControler();
                switch($request->getMethod()) {
                    case 'GET':
                        return $controler->proceedListArticles($request);
                    case 'POST':
                        return $controler->proceedCreateArticle($request);
                    case 'PUT':
                        return $controler->proceedUpdateArticle($request);
                    case 'DELETE':
                        return $controler->proceedDeleteArticle($request);
                }

            case '/article/list':
                switch($request->getMethod()) {
                    case 'POST':
                        $controler = new ArticleApiControler();
                        return $controler->proceedListArticlesByAuthor($request);
                    case 'GET':
                        $controler = new ArticleApiControler();
                        return $controler->proceedListArticlesByCategory($request);    
                    }

                
            case '/category':
                switch($request->getMethod()) {
                    case 'POST':
                        $controler = new CategoryApiControler();
                        return $controler->proceedCreateCategory($request);
                    case 'GET':
                        $controler = new CategoryApiControler();
                        return $controler->proceedGetCategories();    
                    }

            case '/picture':
                switch($request->getMethod()){
                    case 'DELETE':
                        $controler = new ImageApiControler();
                        return $controler->deleteImg($request);
                }

            case '/login':
                $controler = new LoginApiControler();
                return $controler->proceedConnexion($request);
    
            case '/logout':
                $controler = new AccountApiControler();
                return $controler->proceedDestroySession();
    
            
            default:
                $response = new Response();
                $response->setHttpStatusCode(HttpStatusCode::NOT_FOUND);
                $response->setErrors([
                    "Route $page not found !"
                ]);
                return $response;
        }
    }

    public function processLoad(): Response {
        $response = new Response; 
        $response->setErrors(['ok du con']);
        return $response;
    }
}

?>
