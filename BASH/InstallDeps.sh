readonly DEPS=(
	"hollywood"
    "zip"
    "unzip"
)

function __installDeps() {
    local COUNT=0
    __heading 'Searching for dependencies'
    for DEP in ${DEPS[@]}; do
        dpkg -s $DEP &> /dev/null # check if package exists
        if [[ $? -ne 0 ]]; then
            COUNT=$((COUNT+1))
            __messages 'warn' "\"${DEP}\" not found"
            __messages 'info' "Installing \"${DEP}\""
            apt install $DEP -y &> /dev/null # install package
            if [[ $? -ne 0 ]]; then
                __messages 'error' "Installation of \"${DEP}\" failed"
                __messages 'info' 'try: sudo apt update'
                exit 1
            fi
            __messages 'success' "Installation of \"${DEP}\" suceeded"
        fi
    done
    if [[ $COUNT -eq 0 ]]; then
        __messages 'success' 'Everithing up to date'
    else
        __messages 'success' "Installed \"$COUNT\" packages"
    fi
    sleep 1 # sleep so you can read the text
}

__installDeps
