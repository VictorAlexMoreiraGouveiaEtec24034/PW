# Implementação de Segurança na Aplicação PHP

## Resumo das Implementações

Este projeto recebeu melhorias importantes para aumentar a segurança da aplicação, especialmente focadas em proteção contra ataques CSRF e controle de acesso para usuários autenticados.

---

## Funcionalidades Implementadas

### 1. Proteção contra Ataques CSRF

- Criação do helper `Funcoes/csrf_helper.php` para geração e validação de tokens CSRF.
- Inclusão do token CSRF em todos os formulários importantes, como:
  - Formulário de login (`index.php`)
  - Formulário de cadastro/edição de usuários (`View/usuario/usuario.php`)
- Validação do token CSRF no backend para todas as requisições que alteram dados:
  - `Funcoes/process_login.php` (login)
  - `Funcoes/usuario.php` (cadastro/edição de usuários)

### 2. Restrição de Acesso para Usuários Não Autenticados

- Criação do helper `Funcoes/auth_helper.php` para centralizar a verificação de autenticação.
- Inclusão da verificação de login em arquivos sensíveis para garantir que apenas usuários autenticados possam acessá-los:
  - `Funcoes/usuario.php`
  - `View/usuario/listarUsuarios.php`
  - `View/usuario/usuario.php`
- Redirecionamento para a página de login (`index.php`) caso o usuário não esteja autenticado.

### 3. Testes Realizados

- Testes completos cobrindo:
  - Fluxo de login com token CSRF válido e inválido.
  - Acesso restrito a páginas protegidas sem autenticação.
  - Fluxo de cadastro/edição de usuários com validação CSRF.
  - Cenários de erro e sucesso para ambos os formulários.

---

## Como Utilizar

- Ao iniciar a aplicação, o usuário deve realizar login para acessar as páginas protegidas.
- Todos os formulários que alteram dados possuem proteção CSRF automática.
- Caso o token CSRF esteja ausente ou inválido, a requisição será rejeitada.
- Usuários não autenticados são redirecionados para a página de login ao tentar acessar páginas protegidas.

---

## Arquivos Principais Modificados/Adicionados

- `Funcoes/csrf_helper.php` - Helper para geração e validação de tokens CSRF.
- `Funcoes/auth_helper.php` - Helper para verificação de autenticação.
- `index.php` - Formulário de login com token CSRF.
- `Funcoes/process_login.php` - Validação do token CSRF no login.
- `Funcoes/usuario.php` - Validação do token CSRF e verificação de autenticação para cadastro/edição.
- `View/usuario/usuario.php` - Inclusão do token CSRF no formulário de cadastro/edição.
- `View/usuario/listarUsuarios.php` - Restrição de acesso para usuários autenticados.

---

## Considerações Finais

Estas melhorias aumentam significativamente a segurança da aplicação, prevenindo ataques CSRF e garantindo que apenas usuários autenticados possam acessar áreas restritas.

Para futuras melhorias, recomenda-se:

- Implementar logout seguro.
- Adicionar controle de permissões por tipo de usuário.
- Monitorar sessões e implementar timeout de sessão.

---
