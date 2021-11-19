CREATE TABLE public.pessoa
(
    id bigint NOT NULL DEFAULT nextval('pessoa_id_seq'::regclass),
    nome_fantasia character varying(150) COLLATE pg_catalog."default",
    sobrenome_razao character varying(150) COLLATE pg_catalog."default",
    cpf_cnpj character varying(40) COLLATE pg_catalog."default",
    rg_ie character varying(40) COLLATE pg_catalog."default",
    nascimento_fundacao date,
    tipo_pessoa integer,
    data_cadastro date,
    data_atualizacao date,
    CONSTRAINT pessoa_pkey PRIMARY KEY (id),
    CONSTRAINT pessoa_cpf_cnpj UNIQUE (cpf_cnpj)
)

TABLESPACE pg_default;

ALTER TABLE public.pessoa
    OWNER to postgres;

COMMENT ON CONSTRAINT pessoa_cpf_cnpj ON public.pessoa
    IS 'NÃO PODE SER POSSIVEL CADASTRO DOIS DOCUMENTOS DE CPF OU CNPJ IGUAIS.';


CREATE TABLE public.arquivo
(
    id bigint NOT NULL DEFAULT nextval('arquivo_id_seq'::regclass),
    diretorio character varying(4000) COLLATE pg_catalog."default",
    extensao character varying(20) COLLATE pg_catalog."default",
    id_pessoa bigint,
    nome_arquivo character varying(400) COLLATE pg_catalog."default",
    titulo character varying(30) COLLATE pg_catalog."default",
    id_produto bigint,
    CONSTRAINT "CHAVE_PRIMARIA_UNICO" PRIMARY KEY (id),
    CONSTRAINT "ARQUIVO_PESSOA" FOREIGN KEY (id_pessoa)
        REFERENCES public.pessoa (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public.arquivo
    OWNER to postgres;

CREATE TABLE public.endereco
(
    id bigint NOT NULL DEFAULT nextval('endereco_id_seq'::regclass),
    id_pessoa bigint,
    cep character varying(10) COLLATE pg_catalog."default",
    logradouro character varying(120) COLLATE pg_catalog."default",
    complemento character varying(120) COLLATE pg_catalog."default",
    bairro character varying(120) COLLATE pg_catalog."default",
    localidade character varying(110) COLLATE pg_catalog."default",
    uf character varying(2) COLLATE pg_catalog."default",
    ibge character varying(10) COLLATE pg_catalog."default",
    numero character varying(12) COLLATE pg_catalog."default",
    titulo character varying(150) COLLATE pg_catalog."default",
    CONSTRAINT endereco_pkey PRIMARY KEY (id),
    CONSTRAINT "ENDERECO_PESSOA" FOREIGN KEY (id_pessoa)
        REFERENCES public.pessoa (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public.endereco
    OWNER to postgres;

COMMENT ON CONSTRAINT "ENDERECO_PESSOA" ON public.endereco
    IS 'RECHAVE ESTRANGEIRA DA PESSOA';


    CREATE TABLE public.contato
(
    id bigint NOT NULL DEFAULT nextval('contato_id_seq'::regclass),
    id_pessoa bigint,
    tipo character varying(50) COLLATE pg_catalog."default",
    titulo character varying(250) COLLATE pg_catalog."default",
    contato character varying(255) COLLATE pg_catalog."default",
    CONSTRAINT contato_pkey PRIMARY KEY (id),
    CONSTRAINT "CONTATO_PESSOA" FOREIGN KEY (id_pessoa)
        REFERENCES public.pessoa (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)

TABLESPACE pg_default;

ALTER TABLE public.contato
    OWNER to postgres;

COMMENT ON CONSTRAINT "CONTATO_PESSOA" ON public.contato
    IS 'CHAVE ESTRANGUEIRA PARA PESSOA.';