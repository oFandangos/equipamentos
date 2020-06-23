- Acessar https://github.com/fflch/equipamentos

- Fazer o Fork para a sua conta

- Clonar para a sua máquina (Botão verde na lateral direita)
git clone LINK

- cd equipamentos

- Adicionar o upstream 
git remote add upstream https://github.com/fflch/equipamentos.git

- composer install

- Copiar o env example para o env 
cp .env.example .env

- Editar o .env
	¬ Alterar o banco de dados para equipamentos e o nome a senha do root da sua máquina
	¬ Inserir o token da senha unica
	¬ Inserir a senha do replicado

- Adicionar o tema da USP 
php artisan vendor:publish --provider="Uspdev\UspTheme\ServiceProvider" --tag=assets --force

- Criar o banco de dados no terminal
	¬ mariadb -uNOMEDOROOT -pSENHADOROOT
	¬ create database equipamentos;
	¬ exit

- Criar as tabelas 
php artisan migrate

- Gerar a key de verificação
php artisan key:generate





