readonly PACKAGES=(
    php
    mysql-server
    hollywood
)

installDeps() {
    local COUNT=0
    messages 'info' "Searching needed packages"
    for PACKAGE in ${PACKAGES[@]}; do
        dpkg -s $PACKAGE &> /dev/null
        if [[ $? -ne 0 ]]; then
            COUNT=$((COUNT++))
            messages 'warn' "\"${PACKAGE}\" not found"
            messages 'info' "installing \"${PACKAGE}\"..."
            apt install $PACKAGE -y &> /dev/null
            if [[ $? -ne 0 ]]; then
                messages 'error' "Installation of \"${PACKAGE}\" failed"
                messages 'info' "try: sudo apt update"
                exit 1
            fi
            messages 'success' "Installation of \"${PACKAGE}\" succeeded"
        fi
    done
    if [[ $COUNT -eq 0 ]]; then
        messages 'success' "Everithing up to date"
    else
        messages 'success' "Installed \"${COUNT}\" packages"
    fi
}

installDeps