create table channels (
    id INTEGER PRIMARY KEY AUTO_INCREMENT
    , channel_origin_id varchar(256) NOT NULL
    , created_at TIMESTAMP NOT NULL DEFAULT 0
    , updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW()
) ENGINE = InnoDB
DEFAULT CHARACTER SET 'utf8';
ALTER TABLE channels AUTO_INCREMENT = 1001;

create table movies (
    id INTEGER PRIMARY KEY AUTO_INCREMENT
    , channels_id varchar(256) NOT NULL
    , video_id varchar(256) NOT NULL
    , prof varchar(256)
    , created_at TIMESTAMP NOT NULL DEFAULT 0
    , updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW()
) ENGINE = InnoDB
DEFAULT CHARACTER SET 'utf8';
ALTER TABLE movies AUTO_INCREMENT = 1001;

