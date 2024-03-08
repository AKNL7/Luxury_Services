<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class AppCustomAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function authenticate(Request $request): Passport
    //La méthode prend un objet Request en paramètre, elle gère une requête liée à une tentative de connexion.
    {
        $email = $request->request->get('email', ''); // recupere l'email 

        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);
        // Elle enregistre le dernier nom d'utilisateur dans la session. Cela est souvent fait pour se souvenir du nom d'utilisateur pour la prochaine tentative de connexion. L'email est stocké dans la session 

      // onstancie une objet passport qui encapsule les informations d'authentification. la méthode retourne l'objet Passport construit.
       return new Passport(
           
        new UserBadge($email), //Il inclut un objet UserBadge avec l'email. Cela suggère que l'authentification est basée sur l'adresse e-mail.
            
            new PasswordCredentials($request->request->get('password', '')), // recupére le mdp et inclut un objet PasswordCredentials avec le mot de passe. L'authentification implique également la vérification du mot de passe fourni.
           
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),// CsrfTokenBadge est utilisé pour se protéger contre les attaques de falsification de requêtes intersites (CSRF). Il vérifie que le token CSRF soumis avec la requête correspond à celui stocké côté serveur.
                new RememberMeBadge(),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        // For example:
        return new RedirectResponse($this->urlGenerator->generate('app_profil'));
        throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    } // Cette methode est la pour definir la redirection aprés l'authentification si reussi ou non.

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
    // La méthode getLoginUrl est utilisée pour récupérer l'URL de connexion.
}
